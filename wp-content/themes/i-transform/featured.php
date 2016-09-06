<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/featured.
 *
 * @package WordPress
 * @subpackage i-transform
 * @since i-transform 1.0
 */
 ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="articlewrap">   
            <header class="entry-header">
                <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                <div class="entry-thumbnail">
                    <?php the_post_thumbnail(); ?>
                    
					<?php if ( comments_open() ) : ?>
                        <div class="comments-link">
                            <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'itransform' ) . '</span>', __( 'One comment so far', 'itransform' ), __( 'View all % comments', 'itransform' ) ); ?>
                        </div><!-- .comments-link -->
                    <?php endif; // comments_open() ?>
                                    
                </div>
                <?php endif; ?>
        
                <?php if ( is_single() ) : ?>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <?php else : ?>
                <h1 class="entry-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h1>
                <?php endif; // is_single() ?>
        
                <div class="entry-meta">
					<?php
                        if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
                            itransform_entry_date();
                    
                        // Translators: used between list items, there is a space after the comma.
                        $categories_list = get_the_category_list( __( ', ', 'itransform' ) );
                        if ( $categories_list ) {
                            echo '<span class="categories-links">' . $categories_list . '</span>';
                        }
                    
                        // Translators: used between list items, there is a space after the comma.
                        $tag_list = get_the_tag_list( '', __( ', ', 'itransform' ) );
                        if ( $tag_list ) {
                            echo '<span class="tags-links">' . $tag_list . '</span>';
                        }
                    ?>	
                    <?php edit_post_link( __( 'Edit', 'itransform' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- .entry-meta -->
            </header><!-- .entry-header -->
        

            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->

        </div>
    </article><!-- #post -->    

        

