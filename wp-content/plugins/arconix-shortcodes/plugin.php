<?php
/**
 * Plugin Name: Arconix Shortcodes
 * Plugin URI: http://arconixpc.com/plugins/arconix-shortcodes
 * Description: A handy collection of shortcodes for your site.
 *
 * Version: 2.0.3
 *
 * Author: John Gardner
 * Author URI: http://arconixpc.com
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 */

class Arconix_Shortcodes {

    /**
     * Construct Method
     *
     * @since 1.0.0
     * @version 1.2.0
     */
    function __construct() {
        $this->constants();

        add_action( 'init',                     'acs_register_shortcodes' );
        add_action( 'add_meta_boxes',           array( $this, 'metabox' ) );
        add_action( 'wp_enqueue_scripts',       array( $this, 'scripts' ) );
        add_action( 'admin_enqueue_scripts',    array( $this, 'admin_css' ) );
        add_action( 'wp_dashboard_setup',       array( $this, 'dashboard_widget' ) );

        add_filter( 'widget_text',              'do_shortcode' );

        include_once( ACS_INCLUDES_DIR .        'shortcodes.php' );
    }

    /**
     * Define plugin constants
     *
     * @since 1.1.0
     */
    function constants() {
        define( 'ACS_VERSION',              '2.0.3' );
        define( 'ACS_URL',                  trailingslashit( plugin_dir_url( __FILE__ ) ) );
        define( 'ACS_INCLUDES_URL',         trailingslashit( ACS_URL . 'includes' ) );
        define( 'ACS_CSS_URL',              trailingslashit( ACS_INCLUDES_URL . 'css' ) );
        define( 'ACS_IMAGES_URL',           trailingslashit( ACS_URL . 'images' ) );
        define( 'ACS_ADMIN_IMAGES_URL',     trailingslashit( ACS_IMAGES_URL . 'admin' ) );
        define( 'ACS_DIR',                  trailingslashit( plugin_dir_path( __FILE__ ) ) );
        define( 'ACS_INCLUDES_DIR',         trailingslashit( ACS_DIR . 'includes' ) );
    }

    /**
     * Register the necessary Javascript and CSS, which can be overridden in 3 different ways.
     * If you'd like to use a different version of the jQuery Tools script {@link http://jquerytools.org/download/}
     * you can add a filter that overrides the the url, version and dependency.
     *
     * If you would like to bundle the Javacsript or CSS funtionality into another file and prevent either of the plugin files
     * from loading at all, return false to the desired pre_register filters
     *
     * @example add_filter( 'pre_register_arconix_shortcodes_js', '__return_false' );
     *
     * If you'd like to modify the Javascript or CSS that is used by the shortcodes, you can copy the arconix-shortcodes.js
     * or arconix-shortcodes.css files to the root of your theme's folder. That will be loaded in place of the plugin's
     * version, which means you can modify it to your heart's content and know the file will be safe when the plugin
     * is updated in the future.
     *
     * @link Codex reference: apply_filters()
     * @link Codex reference: wp_register_script()
     * @link Codex reference: get_stylesheet_directory()
     * @link Codex reference: get_stylesheet_directory_uri()
     * @link Codex reference: get_template_directory()
     * @link Codex reference: get_template_directory_uri()
     * @link Codex reference: wp_enqueue_style()
     *
     * @see ACS_INCLUDES_URL    Defined in this file
     * @see ACS_CSS_URL         Defined in this file
     * @see ACS_VERSION         Defined in this file
     *
     * @since 0.9
     * @version 2.0.2
     */
    function scripts() {
        // Provide script registration args so they can be filtered if necessary
        $jqt_args = apply_filters( 'arconix_jquerytools_reg', array(
            'url' => 'http://cdn.jquerytools.org/1.2.7/tiny/jquery.tools.min.js',
            'ver' => '1.2.7',
            'dep' => 'jquery'
        ) );

        wp_register_script( 'jquery-tools', esc_url( $jqt_args['url'] ), array( $jqt_args['dep'] ), $jqt_args['ver'], true );

        // Allow FontAwesome registration params to be filtered so different versions can be loaded if needed
        $fa_args = apply_filters( 'arconix_fontawesome_css', array(
            'url' => '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css',
            'ver' => '4.2.0',
        ));

        wp_enqueue_style( 'font-awesome', $fa_args['url'], false, $fa_args['ver'] );

        // Use the .min files if SCRIPT_DEBUG is turned off.
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

        // Register the javascript - Check the child theme directory first, the parent theme second, otherwise load the plugin version
        if( apply_filters( 'pre_register_arconix_shortcodes_js', true ) ) {
            if( file_exists( get_stylesheet_directory() . '/arconix-shortcodes.js' ) )
                wp_register_script( 'arconix-shortcodes-js', get_stylesheet_directory_uri() . '/arconix-shortcodes.js', array( 'jquery-tools' ), ACS_VERSION, true );
            elseif( file_exists( get_template_directory() . '/arconix-shortcodes.js' ) )
                wp_register_script( 'arconix-shortcodes-js', get_template_directory_uri() . '/arconix-shortcodes.js', array( 'jquery-tools' ), ACS_VERSION, true );
            else
                wp_register_script( 'arconix-shortcodes-js', ACS_INCLUDES_URL . "arconix-shortcodes{$suffix}.js", array( 'jquery-tools' ), ACS_VERSION, true );
        }

        // Load the CSS - Check the child theme directory first, the parent theme second, otherwise load the plugin version
        if( apply_filters( 'pre_register_arconix_shortcodes_css', true ) ) {
            if( file_exists( get_stylesheet_directory() . '/arconix-shortcodes.css' ) )
                wp_enqueue_style( 'arconix-shortcodes', get_stylesheet_directory_uri() . '/arconix-shortcodes.css', false, ACS_VERSION );
            elseif( file_exists( get_template_directory() . '/arconix-shortcodes.css' ) )
                wp_enqueue_style( 'arconix-shortcodes', get_template_directory_uri() . '/arconix-shortcodes.css', false, ACS_VERSION );
            else
                wp_enqueue_style( 'arconix-shortcodes', ACS_CSS_URL . "arconix-shortcodes{$suffix}.css", false, ACS_VERSION );
        }

    }

    /**
     * Adds a meta box to the sidebar column on the Post and Page edit screens.
     *
     * The list of available post_types is filterable for themes and plugins
     *
     * @link Codex reference: apply_filters()
     * @link Codex reference: add_meta_box()
     *
     * @since 1.1.0
     */
    function metabox() {
        // Allow a theme or plugin to filter the list of post types this meta box is added to
        $post_types = apply_filters( 'arconix_shortcodes_meta_box_post_types', array( 'post', 'page' ) );

        foreach( (array) $post_types as $post_type ) {
            add_meta_box( 'ac-shortcode-list', __( 'Arconix Shortcode List', 'acs' ), array( $this, 'shortcodes_box' ), $post_type, 'side' );
        }
    }

    /**
     * Callback to display the meta box content
     *
     * @uses get_arconix_shortcode_list()   Defined in /includes/shortcodes.php
     *
     * @see ACS_ADMIN_IMAGES_URL    Defined in this file
     *
     * @since 1.1.0
     */
    function shortcodes_box() {
        $shortcodes = get_arconix_shortcode_list();

        if( ! $shortcodes or ! is_array( $shortcodes ) )
            return;

        $return = '<p><a href="http://arcnx.co/aswiki"><img src="' . ACS_ADMIN_IMAGES_URL . 'page-16x16.png">Documentation</a></p><ul>';
        foreach( (array) $shortcodes as $shortcode ) {
            $return .= '<li>[' . $shortcode . ']</li>';
        }
        $return .= '</ul>';

        echo $return;
    }

    /**
     * Adds a news widget to the dashboard.
     *
     * If the filter is returned false or the logged in user isn't an Admin user, it will prevent the dashboard widget
     * from loading. It's a little cleaner than other solutions available.
     *
     * @example add_filter( 'pre_register_arconix_shortcodes_dashboard_widget', '__return_false' );
     *
     * @link Codex reference: wp_add_dashboard_widget()
     * @link Codex reference: current_user_can()
     *
     * @since 1.0
     * @version 1.2.0
     */
    function dashboard_widget() {
        if( apply_filters( 'pre_register_arconix_shortcodes_dashboard_widget', true ) and
            apply_filters( 'arconix_shortcodes_dashboard_widget_security', current_user_can( 'manage_options' ) ) )
                wp_add_dashboard_widget( 'ac-shortcodes', 'Arconix Shortcodes', array( $this, 'acs_dash_widget' ) );
    }

    /**
     * Output for the dashboard widget
     *
     * @link Codex reference: wp_widget_rss_output()
     *
     * @see ACS_ADMIN_IMAGES_URL    Defined in this file
     *
     * @since 1.0
     * @version 1.1.0
     */
    function acs_dash_widget() {
        echo '<div class="rss-widget">';

        wp_widget_rss_output( array(
            'url' => 'http://arconixpc.com/tag/arconix-shortcodes/feed', // feed url
            'title' => 'Arconix Shortcodes News', // feed title
            'items' => 3, //how many posts to show
            'show_summary' => 1, // 1 = display excerpt
            'show_author' => 0, // 1 = display author
            'show_date' => 1 // 1 = display post date
        ) );
        ?>
        <div class="acs-widget-bottom">
            <ul>
                <li><a href="http://arcnx.co/aswiki"><img src="<?php echo ACS_ADMIN_IMAGES_URL . 'page-16x16.png'; ?>">Documentation</a></li>
                <li><a href="http://arcnx.co/ashelp"><img src="<?php echo ACS_ADMIN_IMAGES_URL . 'help-16x16.png'; ?>">Support Forum</a></li>
                <li><a href="http://arcnx.co/astrello"><img src="<?php echo ACS_ADMIN_IMAGES_URL . 'trello-16x16.png'; ?>">Dev Board</a></li>
                <li><a href="http://arcnx.co/assource"><img src="<?php echo ACS_ADMIN_IMAGES_URL . 'github-16x16.png'; ?>">Source Code</a></li>
            </ul>
        </div></div>
        <?php
    }

    /**
     * Includes admin css
     *
     * @link Codex reference: wp_enqueue_style()
     *
     * @see ACS_CSS_URL     Defined in this file
     * @see ACS_VERSION     Defined in this file
     *
     * @since 1.1.0
     */
    function admin_css() {
        wp_enqueue_style( 'arconix-shortcodes-admin', ACS_CSS_URL . 'admin.css', false, ACS_VERSION );
    }

}

new Arconix_Shortcodes;