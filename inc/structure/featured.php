<?php
/**
 * Functions related to front page featured sections
 */


/**
 * Display featured content top
 */
function hybridmag_display_featured_content_top() { ?>
    <section class="hm-featured-top">
        <?php 
            get_template_part( 'template-parts/featured/small' );
            get_template_part( 'template-parts/featured/slider' );
            get_template_part( 'template-parts/featured/tabs' );
            dynamic_sidebar( 'hm-magazine-1' );
        ?>
    </section>
    <?php
}
add_action( 'hybridmag_featured_section_top', 'hybridmag_display_featured_content_top' );


/**
 * Display featured section.
 */
function hybridmag_featured_section() {
    
    if ( ! hybridmag_is_featured_section_displayed() || is_paged() ) {
        return;
    }

    do_action( 'hybridmag_before_featured_section' );

    get_template_part( 'template-parts/featured/slider' );

    do_action( 'hybridmag_after_featured_section' );

}
add_action( 'hybridmag_inside_container', 'hybridmag_featured_section', 30 );


/**
 * Check if the featured section is displayed.
 */
function hybridmag_is_featured_section_displayed( $post_id = 0 ) {

    $displayed = true;

    if ( false == get_theme_mod( 'hybridmag_show_featured_content', true ) ) {
        $displayed = false;
    }

    if ( $displayed && ! hybridmag_is_section_disabled( get_theme_mod( 'hybridmag_featured_content_displayed_on', array( 'front' ) ), $post_id ) ) {
		$displayed = false;
	}

    return $displayed;

}

/**
 * Display posts tabs section.
 */
function hybridmag_featured_tabs_section() {
    
    if ( ! hybridmag_is_featured_tabs_displayed() || is_paged() ) {
        return;
    }

    do_action( 'hybridmag_before_featured_tabs_section' );

    get_template_part( 'template-parts/featured/tabs' );

    do_action( 'hybridmag_after_featured_tabs_section' );

}
add_action( 'hybridmag_inside_container', 'hybridmag_featured_tabs_section', 35 );


/**
 * Check if the post tabs section is displayed.
 */
function hybridmag_is_featured_tabs_displayed( $post_id = 0 ) {

    $displayed = true;

    if ( false == get_theme_mod( 'hybridmag_display_tabbed_posts', true ) ) {
        $displayed = false;
    }

    if ( $displayed && ! hybridmag_is_section_disabled( get_theme_mod( 'hybridmag_featured_tabs_displayed_on', array( 'front' ) ), $post_id ) ) {
		$displayed = false;
	}

    return $displayed;

}

/**
 * Display Magazine Sidebar.
 */
function hybridmag_magazine_sidebar() {
    
    if ( ! is_active_sidebar( 'hybridmag-magazine-1' ) ) {
        return;
    }

    echo '<div class="hm-magazine-1-sb">';

    dynamic_sidebar( 'hybridmag-magazine-1' );

    echo '</div>';
}
//add_action( 'hybridmag_inside_container', 'hybridmag_magazine_sidebar', 40 );
