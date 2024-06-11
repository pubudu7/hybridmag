<?php
/**
 * Displays featured content on the Blog page.
 */

if ( false == get_theme_mod( 'hybridmag_show_featured_content', true ) ) {
    return;
}

    
do_action( 'hybridmag_before_featured_content' ); 

    $hybridmag_fps_source = get_theme_mod( 'hybridmag_featured_posts_source', 'latest' );
    $hybridmag_fps_args = array();

    if ( 'category' === $hybridmag_fps_source ) {
        $hybridmag_fps_category = get_theme_mod( 'hybridmag_featured_posts_category', '' );
        $hybridmag_fps_args = array(
            'cat'                   => $hybridmag_fps_category,
            //'ignore_sticky_posts'   => true,
            'posts_per_page'        => 5,
        );
    } elseif ( 'tag' === $hybridmag_fps_source ) {
        $hybridmag_fps_tag = get_theme_mod( 'hybridmag_featured_posts_tag', '' );
        $hybridmag_fps_args = array(
            'tag'                   => $hybridmag_fps_tag,
            //'ignore_sticky_posts'   => true,
            'posts_per_page'        => 5,
        );
    } else {
        $hybridmag_fps_args = array(
            'posts_per_page'        => 5,
            //'ignore_sticky_posts'   => true,
        );
    }

    $hybridmag_fps_posts = new WP_Query( $hybridmag_fps_args );

    if ( $hybridmag_fps_posts->have_posts() ) : 
    $hybridmag_fp_counter = 1;

    ?>

    <div class="hm-fp1">

    <?php    

        while( $hybridmag_fps_posts->have_posts() ) :

            $hybridmag_fps_posts->the_post();

            if ( $hybridmag_fp_counter == 1 ) { ?>
                <div class="hm-fp1-left">
                    <article class="hm-fp1-lg">
                        <?php if ( has_post_thumbnail() ) { ?>
                            <div class="hm-fp1-lg-img">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'bam-large', array( 'class' => 'bam-fpw-img') ); ?></a>
                            </div>
                        <?php } ?>

                        <div class="hm-fp-overlay">
                            <a class="hm-fp-link-overlay" href="<?php the_permalink(); ?>" rel="bookmark"></a>
                        </div>

                        <div class="hm-fp1-details hm-fp-meta">
                            <?php hybridmag_categories(); ?>
                            <?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
                            <div class="entry-meta">
                                <?php hybridmag_entry_meta(); ?>
                            </div><!-- .entry-meta -->
                        </div>
                    </article>
                </div>

                <div class="hm-fp1-right">

            <?php } else {
                ?>
                    <article class="hm-fp1-sm">
                        <?php if ( has_post_thumbnail() ) { ?>
                            <div class="hm-fp1-sm-img">
                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">	
                                    <?php the_post_thumbnail( 'hm-thumbnail' ); ?>
                                </a>
                            </div>
                        <?php } elseif ( false == get_theme_mod( 'hybridmag_remove_placeholder', false ) ) { ?>
                            <div class="hm-fp1-sm-img">
                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">	
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/sm-img.png' ); ?>" />
                                </a>
                            </div>
                        <?php } ?>
                        <div class="hm-fp1-sm-details">
                            <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
                            <div class="entry-meta"><?php echo hybridmag_posted_on(); ?></div>
                        </div>
                    </article>
                        
                <?php
            }

            $hybridmag_fp_counter++;
        endwhile;
        wp_reset_postdata();

        ?>
                </div><!-- hm-fp1-right -->


    </div><!-- .hm-fp1 -->
    <?php
    endif;
?>

<?php do_action( 'hybridmag_after_featured_content' ); ?>