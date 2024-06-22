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

/**
 * Enqueue styles for block editor.
 */
function hybridmag_block_editor_styles() {

	wp_enqueue_style( 'hm-block-editor-styles', get_theme_file_uri( '/assets/css/block-editor-style.css' ), false, EXALT_VERSION, 'all' );

	$fonts_arr = hybridmag_get_fonts_array();
	if ( ! empty( $fonts_arr ) ) {
		wp_enqueue_style( 'hm-font-import', hybridmag_get_google_font_uri( $fonts_arr ), array(), null );
	}

	// Load default fonts.
	if ( 'Inter' == get_theme_mod( 'hybridmag_font_family_1', 'Inter' ) ) {
		wp_enqueue_style( 'hm-font-inter', get_theme_file_uri( '/assets/css/font-inter.css' ), array(), EXALT_VERSION, 'all' );
	}
	if ( 'Roboto Condensed' == get_theme_mod( 'hybridmag_font_family_2', 'Roboto Condensed' ) ) {
		wp_enqueue_style( 'hm-font-roboto-condensed', get_theme_file_uri( '/assets/css/font-roboto-condensed.css' ), array(), EXALT_VERSION, 'all' );
	}

	$theme_customizations = "";

	$typography_css = hybridmag_custom_typography_css();
	if ( $typography_css ) {
		$theme_customizations .= $typography_css;
	}

	require_once get_parent_theme_file_path( 'inc/css-output.php' );

	$theme_customizations .= hybridmag_custom_css();

	if ( $theme_customizations ) {
		wp_add_inline_style( 'hm-block-editor-styles', $theme_customizations );
	}

    $block_editor_inline_styles = hybridmag_inline_block_editor_styles();

    if ( $block_editor_inline_styles ) {
		wp_add_inline_style( 'hm-block-editor-styles', $block_editor_inline_styles );
	}

}
if ( is_admin() && version_compare( $GLOBALS['wp_version'], '6.3', '>=' ) ) {
	add_action( 'enqueue_block_assets', 'hybridmag_block_editor_styles', 1, 1 );
} else {
	add_action( 'enqueue_block_editor_assets', 'hybridmag_block_editor_styles', 1, 1 );
}