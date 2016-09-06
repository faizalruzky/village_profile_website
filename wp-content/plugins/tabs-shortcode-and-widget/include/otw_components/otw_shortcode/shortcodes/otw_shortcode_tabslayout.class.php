<?php
class OTW_Shortcode_TabsLayout extends OTW_Shortcodes{
	
	public function __construct(){
		
		$this->has_custom_options = true;
		
		parent::__construct();
	}
	/**
	 * register external libs
	 */
	public function register_external_libs(){
	
		$this->add_external_lib( 'css', 'otw-shortcode-general_foundicons', $this->component_url.'css/general_foundicons.css', 'all', 10 );
		$this->add_external_lib( 'css', 'otw-shortcode-social_foundicons', $this->component_url.'css/social_foundicons.css', 'all', 20 );
		$this->add_external_lib( 'css', 'otw-shortcode-jquery-ui', $this->component_url.'css/jquery-ui-1.9.1.css', 'all', 30 );
		
		$this->add_external_lib( 'css', 'otw-shortcode', $this->component_url.'css/otw_shortcode.css', 'all', 100 );
		
		$this->add_external_lib( 'js', 'otw-shortcode-core', $this->component_url.'js/otw_shortcode_core.js', 'all', 99, array( 'jquery' ) );
		$this->add_external_lib( 'js', 'otw-shortcode', $this->component_url.'js/otw_shortcode.js', 'front', 100 );
		$this->add_external_lib( 'js', 'otw-shortcode_live_preview', $this->component_url.'js/otw_shortcode_live_preview.js', 'live_preview', 200 );
	}
	/**
	 * apply settings
	 */
	public function apply_settings(){
		
		$this->settings = array(
		
			'tabs' => array(
				'1'           => $this->get_label( '1 Tab' ),
				'2'           => $this->get_label( '2 Tabs(default)' ),
				'3'           => $this->get_label( '3 Tabs' ),
				'4'           => $this->get_label( '4 Tabs' ),
				'5'           => $this->get_label( '5 Tabs' ),
				'6'           => $this->get_label( '6 Tabs' ),
				'7'           => $this->get_label( '7 Tabs' ),
				'8'           => $this->get_label( '8 Tabs' ),
				'9'           => $this->get_label( '9 Tabs' ),
				'10'          => $this->get_label( '10 Tabs' )
			),
			'default_tabs' => 2,
			
			'styles' => array(
				''              => $this->get_label( 'horizontal(default)' ),
				'vertical-tabs' => $this->get_label( 'vertical' ),
			),
			'default_style' => '',
			
			'icon_types' => array(
			
				''                      => $this->get_label( 'none (Default)' ),
				'general foundicon-settings'      => $this->get_label( 'Settings' ),
				'general foundicon-heart'         => $this->get_label( 'Heart' ),
				'general foundicon-star'          => $this->get_label( 'Star' ),
				'general foundicon-plus'          => $this->get_label( 'Plus' ),
				'general foundicon-minus'         => $this->get_label( 'Minus' ),
				'general foundicon-checkmark'     => $this->get_label( 'Checkmark' ),
				'general foundicon-remove'        => $this->get_label( 'Remove' ),
				'general foundicon-mail'          => $this->get_label( 'Mail' ),
				'general foundicon-calendar'      => $this->get_label( 'Calendar' ),
				'general foundicon-page'          => $this->get_label( 'Page' ),
				'general foundicon-tools'         => $this->get_label( 'Tools' ),
				'general foundicon-globe'         => $this->get_label( 'Globe' ),
				'general foundicon-cloud'         => $this->get_label( 'Cloud' ),
				'general foundicon-error'         => $this->get_label( 'Error' ),
				'general foundicon-right-arrow'   => $this->get_label( 'Right arrow' ),
				'general foundicon-left-arrow'    => $this->get_label( 'Left arrow' ),
				'general foundicon-up-arrow'      => $this->get_label( 'Up arrow' ),
				'general foundicon-down-arrow'    => $this->get_label( 'Down arrow' ),
				'general foundicon-trash'         => $this->get_label( 'Trash' ),
				'general foundicon-add-doc'       => $this->get_label( 'Add Doc' ),
				'general foundicon-edit'          => $this->get_label( 'Edit' ),
				'general foundicon-lock'          => $this->get_label( 'Lock' ),
				'general foundicon-unlock'        => $this->get_label( 'Unlock' ),
				'general foundicon-refresh'       => $this->get_label( 'Refresh' ),
				'general foundicon-paper-clip'    => $this->get_label( 'Paper clip' ),
				'general foundicon-video'         => $this->get_label( 'Video' ),
				'general foundicon-photo'         => $this->get_label( 'Photo' ),
				'general foundicon-graph'         => $this->get_label( 'Graph' ),
				'general foundicon-idea'          => $this->get_label( 'Idea' ),
				'general foundicon-mic'           => $this->get_label( 'Mic' ),
				'general foundicon-cart'          => $this->get_label( 'Cart' ),
				'general foundicon-address-book'  => $this->get_label( 'Address book' ),
				'general foundicon-compass'       => $this->get_label( 'Compass' ),
				'general foundicon-flag'          => $this->get_label( 'Flag' ),
				'general foundicon-location'      => $this->get_label( 'Location' ),
				'general foundicon-clock'         => $this->get_label( 'Clock' ),
				'general foundicon-folder'        => $this->get_label( 'Folder' ),
				'general foundicon-inbox'         => $this->get_label( 'Inbox' ),
				'general foundicon-website'       => $this->get_label( 'Website' ),
				'general foundicon-smiley'        => $this->get_label( 'Smiley' ),
				'general foundicon-search'        => $this->get_label( 'Search' ),
				'general foundicon-phone'         => $this->get_label( 'Phone' ),
				
				'social foundicon-thumb-up'       => $this->get_label( 'Thumb up' ),
				'social foundicon-thumb-down'     => $this->get_label( 'Thumb down' ),
				'social foundicon-rss'            => $this->get_label( 'Rss' ),
				'social foundicon-facebook'       => $this->get_label( 'Facebook' ),
				'social foundicon-twitter'        => $this->get_label( 'Twitter' ),
				'social foundicon-pinterest'      => $this->get_label( 'Pinterest' ),
				'social foundicon-github'         => $this->get_label( 'Github' ),
				'social foundicon-path'           => $this->get_label( 'Path' ),
				'social foundicon-linkedin'       => $this->get_label( 'LinkedIn' ),
				'social foundicon-dribbble'       => $this->get_label( 'Dribbble' ),
				'social foundicon-stumble-upon'   => $this->get_label( 'Stumble upon' ),
				'social foundicon-behance'        => $this->get_label( 'Behance' ),
				'social foundicon-reddit'         => $this->get_label( 'Reddit' ),
				'social foundicon-google-plus'    => $this->get_label( 'Google plus' ),
				'social foundicon-youtube'        => $this->get_label( 'Youtube' ),
				'social foundicon-vimeo'          => $this->get_label( 'Vimeo' ),
				'social foundicon-clickr'         => $this->get_label( 'Clickr' ),
				'social foundicon-slideshare'     => $this->get_label( 'Slideshare' ),
				'social foundicon-picassa'        => $this->get_label( 'Picassa' ),
				'social foundicon-skype'          => $this->get_label( 'Skype' ),
				'social foundicon-instagram'      => $this->get_label( 'instagram' ),
				'social foundicon-foursquare'     => $this->get_label( 'Foursquare' ),
				'social foundicon-delicious'      => $this->get_label( 'Delicious' ),
				'social foundicon-chat'           => $this->get_label( 'Chat' ),
				'social foundicon-torso'          => $this->get_label( 'Torso' ),
				'social foundicon-tumblr'         => $this->get_label( 'Tumblr' ),
				'social foundicon-video-chat'     => $this->get_label( 'Video chat' ),
				'social foundicon-digg'           => $this->get_label( 'Digg' ),
				'social foundicon-wordpress'      => $this->get_label( 'Wordpress' )
			),
			'default_icon_type' => '',
		);
		
	}
	
	/**
	 * Shortcode admin interface
	 */
	public function build_shortcode_editor_options(){
		
		$html = '';
		
		$source = array();
		if( isset( $_POST['shortcode_object'] ) ){
			$source = $_POST['shortcode_object'];
		}
		
		$html .= OTW_Form::select( array( 'id' => 'otw-shortcode-element-tabs', 'label' => $this->get_label( 'Number' ), 'description' => $this->get_label( 'Select number of tabs.' ), 'parse' => $source, 'options' => $this->settings['tabs'], 'value' => $this->settings['default_tabs'], 'data-reload' => '1' ) );
		
		$html .= OTW_Form::select( array( 'id' => 'otw-shortcode-element-style', 'label' => $this->get_label( 'Style' ), 'description' => $this->get_label( 'Horizontal or vertical tabs.' ), 'parse' => $source, 'options' => $this->settings['styles'], 'value' => $this->settings['default_style'] ) );
		
		$html .= OTW_Form::text_input( array( 'id' => 'otw-shortcode-element-title', 'label' => $this->get_label( 'Tabs title' ), 'description' => $this->get_label( 'Optional title for the tabs.' ), 'parse' => $source )  );
		
		$total_tabs = $this->settings['default_tabs'];
		
		if( isset( $source['otw-shortcode-element-tabs'] ) ){
			$total_tabs = $source['otw-shortcode-element-tabs'];
		}
		
		for( $cT = 1; $cT <= $total_tabs; $cT++ )
		{
			$html .= OTW_Form::text_input( array( 'id' => 'otw-shortcode-element-tab_'.$cT.'_title', 'label' => $this->get_label( 'Tab '.$cT.' title' ), 'description' => $this->get_label( 'The tab title.' ), 'parse' => $source )  );
			
			$html .= OTW_Form::select( array( 'id' => 'otw-shortcode-element-tab_'.$cT.'_icon_type', 'label' => $this->get_label( 'Tab '.$cT.' icon' ), 'description' => $this->get_label( 'Optional foundation icon that is placed before the title.' ), 'parse' => $source, 'options' => $this->settings['icon_types'], 'value' => $this->settings['default_icon_type'] )  );
			
			$html .= OTW_Form::uploader( array( 'id' => 'otw-shortcode-element-tab_'.$cT.'_icon_url', 'label' => $this->get_label( 'Tab '.$cT.' Icon URL' ), 'description' => $this->get_label( 'Url to a custom icon.' ), 'parse' => $source )  );
			
			$html .= OTW_Form::text_area( array( 'id' => 'otw-shortcode-element-tab_'.$cT.'_content', 'label' => $this->get_label( 'Tab '.$cT.' content' ), 'description' => $this->get_label( 'The content of the tab. HTML is allowed.' ), 'parse' => $source )  );
		}
		
		return $html;
	}
	
	/**
	 * Shortcode admin interface custom options
	 */
	public function build_shortcode_editor_custom_options(){
		
		$html = '';
		
		$source = array();
		if( isset( $_POST['shortcode_object'] ) ){
			$source = $_POST['shortcode_object'];
		}
		
		$html .= OTW_Form::text_input( array( 'id' => 'otw-shortcode-element-css_class', 'label' => $this->get_label( 'CSS Class' ), 'description' => $this->get_label( 'If you\'d like to style this element separately enter a name here. A CSS class with this name will be available for you to style this particular element..' ), 'parse' => $source )  );
		
		return $html;
	}
	
	/** build shortcode
	 *
	 *  @param array
	 *  @return string
	 */
	public function build_shortcode_code( $attributes ){
		
		$code = '';
		
		if( !$this->has_error ){
		
			$code = '[otw_shortcode_tabslayout';
			
			$code .= $this->format_attribute( 'tabs', 'tabs', $attributes );
			$code .= $this->format_attribute( 'style', 'style', $attributes );
			$code .= $this->format_attribute( 'title', 'title', $attributes, false, '', true );
			
			if( $tabs = $this->format_attribute( '', 'tabs', $attributes ) ){
				
				for( $cT = 1; $cT <= $tabs; $cT++ ){
					$code .= $this->format_attribute( 'tab_'.$cT.'_title', 'tab_'.$cT.'_title', $attributes, false, '', true );
					$code .= $this->format_attribute( 'tab_'.$cT.'_icon_type', 'tab_'.$cT.'_icon_type', $attributes );
					$code .= $this->format_attribute( 'tab_'.$cT.'_icon_url', 'tab_'.$cT.'_icon_url', $attributes );
					$code .= $this->format_attribute( 'tab_'.$cT.'_content', 'tab_'.$cT.'_content', $attributes, false, '', true );
				}
			}
			
			$code .= $this->format_attribute( 'css_class', 'css_class', $attributes, false, '', true  );
			
			$code .= ']';
			
			
			$code .= '[/otw_shortcode_tabslayout]';
		}
		
		return $code;

	}
	
	/**
	 * Display shortcode
	 */
	public function display_shortcode( $attributes, $content ){
		
		$html = '<div';
		
		/*class attributes*/
		$class = 'otw-sc-tabs ui-tabs ui-widget ui-widget-content ui-corner-all';
		
		$class .= $this->format_attribute( '', 'style', $attributes, false, $class );
		
		$class .= $this->format_attribute( '', 'css_class', $attributes, false, $class );
		
		if( strlen( $class ) ){
			$html .= ' class="'.$class.'"';
		}
		/*end class attributes*/
		
		/*style attribute*/
		$style = '';
		
		if( strlen( $style ) ){
			$html .= ' style="'.$style.'"';
		}
		
		$html .= '>';
		$html .= '<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">';
		
		if( $title = $this->format_attribute( '', 'title', $attributes, false, '' ) ){
			$html .= '<li>';
			$html .= '<span class="tab-title">'.$title.'</span>';
			$html .= '</li>';
		}
		if( $tabs = $this->format_attribute( '', 'tabs', $attributes, false, '' ) ){
		
			for( $cT = 1; $cT <= $tabs; $cT++ ){
				$html .= '<li class="ui-state-default ui-corner-top">';
				$html .= '<a href="#tabs-'.$cT.'"';
				$html .= '>';
				
				if( $tab_icon_type = $this->format_attribute( '', 'tab_'.$cT.'_icon_type', $attributes, false, '' ) ){
					$html .= '<i class="'.$tab_icon_type.'"> </i>';
				}
				if( $tab_icon_url = $this->format_attribute( '', 'tab_'.$cT.'_icon_url', $attributes, false, '' ) ){
					$html .= '<img src="'.$tab_icon_url.'" title="icon" alt="icon" />';
				}
				if( $tab_title = $this->format_attribute( '', 'tab_'.$cT.'_title', $attributes, false, '' ) ){
					$html .= $tab_title;
				}
				
				$html .= '</a>';
				$html .= '</li>';
			}
		}
		
		$html .= '</ul>';
		if( $tabs = $this->format_attribute( '', 'tabs', $attributes, false, '' ) ){
			
			for( $cT = 1; $cT <= $tabs; $cT++ ){
				
				$html .= '<div id="tabs-'.$cT.'" class="ui-tabs-panel ui-widget-content ui-corner-bottom">';
				$html .= '<p>'.nl2br( otw_htmlentities_decode( $this->format_attribute( '', 'tab_'.$cT.'_content', $attributes, false, '' ) ) ).'</p>';
				$html .= '</div>';
			}
		}
		
		$html .= '</div>';
		return $html;
	}
}
