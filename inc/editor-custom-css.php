<?php

/**
 * Custom CSS for gutenberg editor.
 * 
 * @package HybridMag
 */

 function hybridmag_get_editor_typography_elements() {
    return apply_filters( 'hybridmag_editor_typography_elements', array (
        'body'  => array(
            'title'     => esc_html__( 'Body', 'hybridmag' ),
            'target'    => 'html .editor-styles-wrapper',
            'defaults'  => array()
        ),

        'headings'  => array(
            'title'     => esc_html__( 'Headings', 'hybridmag' ),
            'target'    => 'html .editor-styles-wrapper h1, html .editor-styles-wrapper h2, html .editor-styles-wrapper h3, html .editor-styles-wrapper h4, html .editor-styles-wrapper h5, html .editor-styles-wrapper h6',
            'defaults'  => array(),
            'exclude'   => array( 'font-size' ),
        ),

        'single_post_body'  => array(
            'title'     => esc_html__( 'Single Post Content', 'hybridmag' ),
            'target'    => 'html .editor-styles-wrapper',
            'defaults'  => array(),
            'exclude'   => array( 'font-family' )
        )

        )
    );
}

function hybridmag_block_editor_css() {

    $css = '';
            
    $elements = hybridmag_get_editor_typography_elements();

    foreach ( $elements as $element => $values ) {
        
        $properties = array(
            'font-family',
            'font-weight',
            'font-style',
            'text-transform',
            'font-size',
            'line-height'
        );

        $common_css = '';
        $tablet_css = '';
        $mobile_css = '';

        foreach( $properties as $property ) {

            $setting = str_replace( '-', '_', $property );

            // font size css properties and values.
            if ( 'font-size' == $property ) {
                
                // Get default values for each device.
                $default_desktop        = isset( $values['defaults'][$property]['desktop'] ) ? $values['defaults'][$property]['desktop'] : '';
                $default_tablet         = isset( $values['defaults'][$property]['tablet'] ) ? $values['defaults'][$property]['tablet'] : '';
                $default_mobile         = isset( $values['defaults'][$property]['mobile'] ) ? $values['defaults'][$property]['mobile'] : '';

                // Theme mods for each setting.
                $theme_setting_desktop          = get_theme_mod( 'hybridmag_'. $element .'_desktop_'. $setting, $default_desktop );
                $theme_setting_tablet           = get_theme_mod( 'hybridmag_'. $element .'_tablet_'. $setting, $default_tablet );
                $theme_setting_mobile           = get_theme_mod( 'hybridmag_'. $element .'_mobile_'. $setting, $default_mobile );

                // CSS properties and values for desktop.
                if ( ! empty( $theme_setting_desktop ) && $default_desktop != $theme_setting_desktop ) {
                    $common_css .= $property .':'. esc_attr( $theme_setting_desktop ) .';';
                } 

                // CSS properties and values for tablet.
                if ( ! empty( $theme_setting_tablet ) && $default_tablet != $theme_setting_tablet ) {
                    $tablet_css .= $property .':'. esc_attr( $theme_setting_tablet ) .';';
                } 
                
                // CSS properties and values for mobile.
                if ( ! empty( $theme_setting_mobile ) && $default_mobile != $theme_setting_mobile ) {
                    $mobile_css .= $property .':'. esc_attr( $theme_setting_mobile ) .';';
                }

            } elseif ( $property == 'font-family' ) {

                // Default values defined in elements array.
                $default = isset( $values['defaults'][$property] ) ? $values['defaults'][$property] : '';

                // Theme mod.
                $theme_setting = get_theme_mod( 'hybridmag_'. $element .'_'. $setting, $default );

                // CSS properties and values.
                if ( ! empty( $theme_setting ) && $default != $theme_setting ) {
                    $common_css .= $property .':'. esc_attr( $theme_setting ).';';
                }

            } else {
                // Default values defined in elements array.
                $default = isset( $values['defaults'][$property] ) ? $values['defaults'][$property] : '';

                // Theme mod.
                $theme_setting = get_theme_mod( 'hybridmag_'. $element .'_'. $setting, $default );

                // CSS properties and values.
                if ( ! empty( $theme_setting ) && $default != $theme_setting ) {
                    $common_css .= $property .':'. esc_attr( $theme_setting ).';';
                }
            }

        }

        // Targeted selectors
        $selectors = $values['target'];

        // Common CSS appiled to all devices.
        if ( ! empty( $common_css ) ) {
            $css .= $selectors .'{'. $common_css .'}';
        }

        // CSS for tablet devices.
        if ( ! empty( $tablet_css ) ) {
            $css .= '@media(max-width: 768px){'. $selectors .'{'. $tablet_css .'}}';
        }

        // CSS for mobile devices.
        if ( ! empty( $mobile_css ) ) {
            $css .= '@media(max-width: 480px){'. $selectors .'{'. $mobile_css .'}}';
        }

    }

    return $css;

}

function hybridmag_block_editor_styles() {

    $fonts_arr = hybridmag_typography_loop( 'fonts' );
	if ( ! empty( $fonts_arr ) ) {
		wp_enqueue_style( 'hybridmag-block-editor-fonts', hybridmag_get_google_font_uri( $fonts_arr ), array(), null );
	}

    // Block styles.
    wp_enqueue_style( 'hybridmag-block-editor-styles', get_theme_file_uri( '/assets/css/block-editor-style.css' ), false, HYBRIDMAG_VERSION, 'all' );

    $theme_customizations = '';

    // Get block editor related customizations.
    $theme_customizations .= hybridmag_block_editor_css();

    require_once get_parent_theme_file_path( 'inc/css-output.php' );

    // Get theme custom styles.
	$theme_customizations .= hybridmag_custom_css();

	if ( $theme_customizations ) {
		wp_add_inline_style( 'hybridmag-block-editor-styles', $theme_customizations );
	}

    $block_editor_inline_styles = hybridmag_inline_block_editor_styles();

    if ( $block_editor_inline_styles ) {
		wp_add_inline_style( 'hybridmag-block-editor-styles', $block_editor_inline_styles );
	}

}
if ( is_admin() && version_compare( $GLOBALS['wp_version'], '6.3', '>=' ) ) {
	add_action( 'enqueue_block_assets', 'hybridmag_block_editor_styles', 1, 1 );
} else {
	add_action( 'enqueue_block_editor_assets', 'hybridmag_block_editor_styles', 1, 1 );
}