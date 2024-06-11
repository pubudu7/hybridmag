<?php

/**
 * HybridMag: Typography functions.
 * 
 * @package HybridMag
 */

function hybridmag_custom_typography_css() {
    $body_font = get_theme_mod( 'hybridmag_font_family_1', 'Inter' );
    $body_font_fallback = get_theme_mod( 'hybridmag_body_font_fallback', 'sans-serif' );
    $headings_font = get_theme_mod( 'hybridmag_font_family_2', 'Roboto Condensed' );
    $headings_font_fallback = get_theme_mod( 'hybridmag_headings_font_fallback', 'sans-serif' );
    $headings_font_weight = get_theme_mod( 'hybridmag_headings_font_weight', '' );

    $site_title_desktop_font_size   = get_theme_mod( 'hybridmag_site_title_desktop_font_size', '' );
    $site_title_tablet_font_size    = get_theme_mod( 'hybridmag_site_title_tablet_font_size', '' );
    $site_title_mobile_font_size    = get_theme_mod( 'hybridmag_site_title_mobile_font_size', '' );

    $post_desktop_font_size   = get_theme_mod( 'hybridmag_post_desktop_font_size', '' );
    $post_tablet_font_size    = get_theme_mod( 'hybridmag_post_tablet_font_size', '' );
    $post_mobile_font_size    = get_theme_mod( 'hybridmag_post_mobile_font_size', '' );    

    $css = '';
    $block_editor_css = '';

    if ( $body_font ) {
        $css .= '
            :root {
                --hm-font-family-body: ' . wp_kses( $body_font, null ) . ', ' . esc_attr( $body_font_fallback, null ) .';
            }
        ';

        $block_editor_css .= '
            :root .editor-styles-wrapper {
                --hm-font-family-body: ' . wp_kses( $body_font, null ) . ', ' . esc_attr( $body_font_fallback, null ) .';
            }
        ';
    }

    if ( $headings_font ) {
        $css .= '
            :root {
                --hm-font-family-headings: ' . wp_kses( $headings_font, null ) . ', ' . esc_attr( $headings_font_fallback, null ) .';
            }
        ';

        $block_editor_css .= '
            :root .editor-styles-wrapper {
                --hm-font-family-headings: ' . wp_kses( $headings_font, null ) . ', ' . esc_attr( $headings_font_fallback, null ) .';
            }
        ';
    }

    if ( $headings_font_weight ) {
        $css .= '
            :root {
                --hm-font-weight-headings: ' . esc_attr( $headings_font_weight ) . ';
            }
        ';

        $block_editor_css .= '
            :root .editor-styles-wrapper {
                --hm-font-weight-headings: ' . esc_attr( $headings_font_weight ) . ';
            }
        ';
    }

    // Site title font size.
    if ( $site_title_desktop_font_size ) {
        $css .= '
            .site-title {
                font-size: ' . esc_attr( $site_title_desktop_font_size ) . ';
            }
        ';
    }

    if ( $site_title_tablet_font_size ) {
        $css .= '
            @media screen and (max-width: 768px) {
                .site-title {
                    font-size: ' . esc_attr( $site_title_tablet_font_size ) . ';
                }
            }
        ';
    }

    if ( $site_title_mobile_font_size ) {
        $css .= '
            @media screen and (max-width: 600px) {
                .site-title {
                    font-size: ' . esc_attr( $site_title_mobile_font_size ) . ';
                }
            }
        ';
    }

    // Post font size.
    if ( $post_desktop_font_size ) {
        $css .= '
            .hm-entry-single .entry-content {
                font-size: ' . esc_attr( $post_desktop_font_size ) . ';
            }
        ';

        $block_editor_css .= '
            .editor-styles-wrapper .wp-block-post-content {
                font-size: ' . esc_attr( $post_desktop_font_size ) . ';
            }
        ';
    }

    if ( $post_tablet_font_size ) {
        $css .= '
            @media screen and (max-width: 768px) {
                .hm-entry-single .entry-content {
                    font-size: ' . esc_attr( $post_tablet_font_size ) . ';
                }
            }
        ';

        $block_editor_css .= '
            @media screen and (max-width: 768px) {
                .editor-styles-wrapper .wp-block-post-content {
                    font-size: ' . esc_attr( $post_desktop_font_size ) . ';
                }
            }
        ';
    }

    if ( $post_mobile_font_size ) {
        $css .= '
            @media screen and (max-width: 600px) {
                .hm-entry-single .entry-content {
                    font-size: ' . esc_attr( $post_mobile_font_size ) . ';
                }
            }
        ';

        $block_editor_css .= '
            @media screen and (max-width: 600px) {
                .editor-styles-wrapper .wp-block-post-content {
                    font-size: ' . esc_attr( $post_desktop_font_size ) . ';
                }
            }
        ';
    }

    if ( '' !== $css ) {
        $theme_css = $css;
    } else {
        $theme_css = '';
    }

    if ( '' !== $block_editor_css ) {
        $editor_css = $block_editor_css;
    } else {
        $editor_css = '';
    }

    if ( function_exists( 'register_block_type' ) && is_admin() ) {
        $theme_css = $editor_css;
    }

    /**
     * hybridmag_theme_typography_css hook since HybridMag 1.1.0
     */
    return $theme_css = apply_filters( 'hybridmag_theme_typography_css', $theme_css, $block_editor_css );

}