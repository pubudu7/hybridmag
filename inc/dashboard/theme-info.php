<?php

function hybridmag_enqueue_admin_scripts( $hook ) {
    if ( $hook === 'post.php' || $hook === 'post-new.php' || 'appearance_page_hybridmag' == $hook ) {
        wp_register_style( 'hybridmag-admin-css', get_template_directory_uri() . '/inc/dashboard/css/admin.css', false, '1.0.0' );
        wp_enqueue_style( 'hybridmag-admin-css' );
    }
    if ( 'appearance_page_hybridmag' === $hook ) {
        wp_enqueue_script( 'updates' );
        wp_enqueue_script( 'hybridmag-recommended-plugins', get_template_directory_uri() . '/inc/dashboard/js/plugin-install.js', array( 'jquery' ) );
        wp_localize_script( 'hybridmag-recommended-plugins', 'hybridmag_plugins_object',
        array(
            'installing' => esc_html__( 'Installing', 'hybridmag' ),
            'activating' => esc_html__( 'Activating', 'hybridmag' ),
            'error'      => esc_html__( 'Error', 'hybridmag' ),
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
        ));
    }
}
add_action( 'admin_enqueue_scripts', 'hybridmag_enqueue_admin_scripts' );

/**
 * Add admin notice when active theme
 */
function hybridmag_admin_notice() {
    ?>
    <div class="updated notice notice-info is-dismissible">
        <p><?php esc_html_e( 'Welcome to HybridMag! To get started with HybridMag please visit the theme Welcome page.', 'hybridmag' ); ?></p>
        <p><a class="button" href="<?php echo esc_url( admin_url( 'themes.php?page=hybridmag' ) ); ?>"><?php _e( 'Get Started with HybridMag', 'hybridmag' ) ?></a></p>
    </div>
    <?php
}


function hybridmag_activation_admin_notice(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
        add_action( 'admin_notices', 'hybridmag_admin_notice' );
    }
}
add_action( 'load-themes.php',  'hybridmag_activation_admin_notice'  );


function hybridmag_add_themeinfo_page() {

    // Menu title can be displayed with recommended actions count.
    $menu_title = esc_html__( 'HybridMag Theme', 'hybridmag' );

    add_theme_page( esc_html__( 'HybridMag Theme', 'hybridmag' ), $menu_title , 'edit_theme_options', 'hybridmag', 'hybridmag_themeinfo_page_render' );

}
add_action( 'admin_menu', 'hybridmag_add_themeinfo_page' );

function hybridmag_themeinfo_page_render() { ?>

    <div class="th-theme-info-page">

        <div class="th-admin-header-section">
            <div class="th-admin-container">
                <div class="th-admin-theme-info">
                    <span class="th-admin-theme-name"><?php echo esc_html( 'HybridMag', 'hybridmag'); ?></span>
                    <span class="th-admin-theme-version">
                        v<?php echo esc_html( wp_get_theme()->get( 'Version' ) ); ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="th-hm-admin-navbar">
            <div class="th-admin-container">
                <div class="th-nav-tab-wrapper">
                    <a class="th-nav-tab <?php if ( $_GET['page'] == 'hybridmag' && ! isset( $_GET['tab'] ) ) echo 'th-nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'hybridmag' ), 'themes.php' ) ) ); ?>">
                        <?php esc_html_e( 'Welcome', 'hybridmag'); ?>
                    </a>
                    <a class="th-nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'starter-templates' ) echo 'th-nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'hybridmag', 'tab' => 'starter-templates' ), 'themes.php' ) ) ); ?>">
                        <?php esc_html_e( 'Starter Templates', 'hybridmag' ); ?>
                    </a>
                    <a class="th-nav-tab menu-get-pro-link" href="https://themezhut.com/themes/hybridmag-pro/" target="_blank">
                        <?php esc_html_e( 'Get HybridMag Pro' ); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="1em" height="1em"><path d="M354.4 83.8C359.4 71.8 371.1 64 384 64L544 64C561.7 64 576 78.3 576 96L576 256C576 268.9 568.2 280.6 556.2 285.6C544.2 290.6 530.5 287.8 521.3 278.7L464 221.3L310.6 374.6C298.1 387.1 277.8 387.1 265.3 374.6C252.8 362.1 252.8 341.8 265.3 329.3L418.7 176L361.4 118.6C352.2 109.4 349.5 95.7 354.5 83.7zM64 240C64 195.8 99.8 160 144 160L224 160C241.7 160 256 174.3 256 192C256 209.7 241.7 224 224 224L144 224C135.2 224 128 231.2 128 240L128 496C128 504.8 135.2 512 144 512L400 512C408.8 512 416 504.8 416 496L416 416C416 398.3 430.3 384 448 384C465.7 384 480 398.3 480 416L480 496C480 540.2 444.2 576 400 576L144 576C99.8 576 64 540.2 64 496L64 240z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="th-nav-tab-inner">

            <?php

                $current_tab = ! empty( $_GET['tab'] ) ? sanitize_title( $_GET['tab'] ) : '';

                if ( $current_tab == 'starter-templates' ) {
                    echo '<div class="th-admin-container">';
                        hybridmag_starter_templates();
                    echo '</div>';
                } else {
                    hybridmag_admin_welcome_page();
                } 
            
            ?>

        </div><!-- .th-nav-tab-inner -->
        


    </div><!-- .th-theme-info-page -->

    <?php

}

function hybridmag_starter_templates() {
    if ( function_exists( 'bnmbt_display_demo_showcase' ) ) {
        bnmbt_display_demo_showcase();
    } else {
        hybridmag_plugin_for_demo_install();
    }
}

/**
 * Recommend Post Blocks & Tools plugin to install demos.
 */
function hybridmag_plugin_for_demo_install() {

    $slug = 'bnm-blocks';

    $is_installed = hybridmag_is_plugin_installed( $slug );
    $is_activated = function_exists( 'bnmbt_display_demo_showcase' );
    $plugin_path  = hybridmag_get_plugin_basename_from_slug( $slug );

    if ( ! $is_installed ) {

        $plugin_install_url = add_query_arg(
            array(
                'action' => 'install-plugin',
                'plugin' => $slug,
            ),
            self_admin_url( 'update.php' )
        );
        $plugin_install_url = wp_nonce_url( $plugin_install_url, 'install-plugin_' . $slug );
    
        $button_html = sprintf('<a class="themezhut-plugin-install install-now button-secondary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
            esc_attr( $slug ),
            esc_url( $plugin_install_url ),
            /* translators: %s: plugin name */
            esc_html__( 'Install Post Blocks & Tools Plugin Now', 'hybridmag' ),
            esc_html__( 'Post Blocks & Tools', 'hybridmag' ),
            esc_html__( 'Install and activate', 'hybridmag' )
        );

    } elseif ( $is_installed && ! $is_activated ) {
        
        $plugin_activate_link = add_query_arg(
            array(
                'action'        => 'activate',
                'plugin'        => rawurlencode( $plugin_path ),
                'plugin_status' => 'all',
                'paged'         => '1',
                '_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $plugin_path ),
            ), self_admin_url( 'plugins.php' )
        );

        global $pagenow;
        if ( "themes.php" != $pagenow && is_admin() ) {
            $activate_string = esc_html__( 'Activate', 'hybridmag' );
        } else {
            $activate_string = esc_html__( 'Activate Plugin', 'hybridmag' );
        }

        $button_html = sprintf('<a class="themezhut-plugin-activate activate-now button-primary button" data-slug="%1$s" href="%2$s" aria-label="%3$s" data-name="%4$s">%5$s</a>',
            esc_attr( $slug ),
            esc_url( $plugin_activate_link ),
            /* translators: %s: plugin name */
            esc_html__( 'Activate Post Blocks & Tools Plugin Now', 'hybridmag' ),
            esc_html__( 'Post Blocks & Tools', 'hybridmag' ),
            $activate_string
        );

    }
    ?>

    <div class="th-demo-plugin-notice">
        <p>
        <?php 
            echo esc_html__( 'To import demos, simply install and activate our "Post Blocks & Tools" plugin. Click to install and activate.', 'hybridmag' ); 
        ?>
        </p>
        <?php echo $button_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above ?>
    </div>

    <?php

}

function hybridmag_get_plugin_basename_from_slug( $slug ) {
    $keys = array_keys( hybridmag_get_installed_plugins() );
    foreach ( $keys as $key ) {
        if ( preg_match( '|^' . $slug . '/|', $key ) ) {
            return $key;
        }
    }
    return $slug;
}

function hybridmag_get_installed_plugins() {
    if ( ! function_exists( 'get_plugins' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    return get_plugins();
}

function hybridmag_is_plugin_installed( $slug ) {
    $installed_plugins = hybridmag_get_installed_plugins(); // Retrieve a list of all installed plugins (WP cached).
    $file_path         = hybridmag_get_plugin_basename_from_slug( $slug );
    return ( ! empty( $installed_plugins[ $file_path ] ) );
}

function hybridmag_admin_welcome_page() {
    ?>
    <div class="th-admin-container">
        <div class="th-theme-details-page">
        
            <div class="th-admin-theme-content">
                <div class="th-admin-theme-settings">
                    <div class="th-admin-theme-setting-header">
                        <h3 class="th-admin-theme-setting-title"><?php echo esc_html__( 'Get Started', 'hybridmag' ); ?></h3>
                        <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button"><?php echo esc_html__( 'Go to Customizer', 'hybridmag' ); ?></a>
                    </div>
                    
                    <div class="th-admin-theme-setting-links">
                        <div class="th-admin-theme-setting-box">
                            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=title_tagline' ) ); ?>" target="_blank">
                                <span class="th-admin-qsc-name"><?php echo esc_html__( 'Upload Logo', 'hybridmag' ); ?></span>
                            </a>
                        </div>

                        <div class="th-admin-theme-setting-box">
                            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=hybridmag_panel_header' ) ); ?>" target="_blank">
                                <span class="th-admin-qsc-name"><?php echo esc_html__( 'Header Options', 'hybridmag' ); ?></span>
                            </a>
                        </div>

                        <div class="th-admin-theme-setting-box">
                            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=hybridmag_colors_panel' ) ); ?>" target="_blank">
                                <span class="th-admin-qsc-name"><?php echo esc_html__( 'Change Colors', 'hybridmag' ); ?></span>
                            </a>
                        </div>

                        <div class="th-admin-theme-setting-box">
                            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[section]=title_tagline' ) ); ?>" target="_blank">
                                <span class="th-admin-qsc-name"><?php echo esc_html__( 'Layout Options', 'hybridmag' ); ?></span>
                            </a>
                        </div>

                        <div class="th-admin-theme-setting-box">
                            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=hybridmag_typography_panel' ) ); ?>" target="_blank">
                                <span class="th-admin-qsc-name"><?php echo esc_html__( 'Typography', 'hybridmag' ); ?></span>
                            </a>
                        </div>

                        <div class="th-admin-theme-setting-box">
                            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=hybridmag_panel_blog' ) ); ?>" target="_blank">
                                <span class="th-admin-qsc-name"><?php echo esc_html__( 'Blog Options', 'hybridmag' ); ?></span>
                            </a>
                        </div>

                        <div class="th-admin-theme-setting-box">
                            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=hybridmag_panel_footer' ) ); ?>" target="_blank">
                                <span class="th-admin-qsc-name"><?php echo esc_html__( 'Footer Options', 'hybridmag' ); ?></span>
                            </a>
                        </div>

                        <div class="th-admin-theme-setting-box">
                            <a href="<?php echo esc_url( admin_url( 'themes.php?page=hybridmag&tab=starter-templates' ) ); ?>">
                                <span class="th-admin-qsc-name"><?php echo esc_html__( 'Starter Templates / Demo Installation', 'hybridmag' ); ?></span>
                            </a>
                        </div>
                    </div><!-- .th-admin-theme-setting-links -->
                </div><!-- .th-admin-theme-settings -->
            </div><!-- .th-admin-theme-content -->
            <div class="th-admin-theme-sidebar">
                <div class="th-admin-quick-access-links">
                    <?php echo esc_html__( 'Quick Links', 'hybridmag' ); ?>
                    <ul>
                        <li><a href="https://themezhut.com/contact/" target="_blank"><?php echo esc_html__( 'Developer Support', 'hybridmag' ); ?></a></li>
                        <li><a href="https://themezhut.com/hybridmag-wordpress-theme-documentation/" target="_blank"><?php echo esc_html__( 'Documentation', 'hybridmag' ); ?></a></li>
                        <li><a href="https://themezhut.com/themes/hybridmag/" target="_blank"><?php echo esc_html__( 'Changelog', 'hybridmag' ); ?></a></li>
                        <li><a href="https://wordpress.org/support/theme/hybridmag/reviews/#new-post" target="_blank"><?php echo esc_html__( 'Rate Us', 'hybridmag' ); ?></a></li>
                    </ul>
                </div>
            </div><!-- .th-admin-theme-sidebar -->

        </div>
    </div>

    <?php
}