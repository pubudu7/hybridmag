<?php
/**
 * Functions related to block editor
 */

/**
 * Check wgat sidebar layout we are using on the current editing post.
 */
function hybridmag_get_block_editor_sidebar_layout() {

	$layout = 'right-sidebar';

	if ( function_exists( 'get_current_screen' ) ) {
		$screen = get_current_screen();

		if ( is_object( $screen ) ) {
            if ( 'post' == $screen->post_type ) {
                $layout = get_theme_mod( 'hybridmag_post_layout', 'right-sidebar' );
            } elseif ( 'page' == $screen->post_type ) {
                $layout = get_theme_mod( 'hybridmag_page_layout', 'right-sidebar' );
            }
        } 

	}

	$layout = apply_filters( 'hybridmag_sidebar_layout', $layout );

	$layout_meta = get_post_meta( get_the_ID(), '_hybridmag_layout_meta', true );

	if ( $layout_meta && 'default-layout' != $layout_meta ) {
		$layout = $layout_meta;
	}

	return apply_filters( 'hybridmag_block_editor_sidebar_layout', $layout );

}

 /**
 * Get the content width for current post
 */
function hybridmag_get_block_editor_content_width() {
	
	$site_layout = get_theme_mod( 'hybridmag_site_layout', 'wide' );
	if ( 'boxed' == $site_layout ) {
		$boxed_width = get_theme_mod( 'hybridmag_boxed_width', 1380 );
		$container_width = ( $boxed_width * 92.7536231884058 ) / 100;
	} else {
		$container_width = get_theme_mod( 'hybridmag_container_width', 1280 );
	}
	
	$sidebar_width = get_theme_mod( 'hybridmag_sidebar_width', 29.6875 );
	$layout = hybridmag_get_block_editor_sidebar_layout();

	if ( 'left-sidebar' === $layout || 'right-sidebar' === $layout ) {
		$content_width = $container_width * ( ( 100 - $sidebar_width ) / 100 );
	} elseif ( 'no-sidebar' === $layout ) {
		$content_width = $container_width;
	} else {
		$content_width = 900;
	}

	return apply_filters( 'hybridmag_block_editor_content_width', $content_width );
}

/**
 * Inline styles for the block editor.
 */
function hybridmag_inline_block_editor_styles() {
    $custom_css = "";

    $css_variables = "";

    $content_width = hybridmag_get_block_editor_content_width();

    if ( $content_width ) {
        $css_variables .= '
            --hybridmag-content_width: '. esc_attr( $content_width ) .'px !important;
        ';
    }

    $custom_css .= '
        :root { ' . $css_variables . ' }
    ';

    $custom_css .= '
        .wp-block {
            max-width: '. esc_attr( $content_width ) .'px;
        }
    ';

    return $custom_css;
}