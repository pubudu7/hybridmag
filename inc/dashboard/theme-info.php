<?php

function hybridmag_enqueue_admin_scripts( $hook ) {
    if ( 'appearance_page_about-hm-theme' != $hook ) {
        return;
    }
    wp_register_style( 'hm-admin-css', get_template_directory_uri() . '/inc/dashboard/css/admin.css', false, '1.0.0' );
    wp_enqueue_style( 'hm-admin-css' );
}
add_action( 'admin_enqueue_scripts', 'hybridmag_enqueue_admin_scripts' );

/**
 * Add admin notice when active theme
 */
function hybridmag_admin_notice() {
    ?>
    <div class="updated notice notice-info is-dismissible">
        <p><?php esc_html_e( 'Welcome to HybridMag! To get started with HybridMag please visit the theme Welcome page.', 'hybridmag' ); ?></p>
        <p><a class="button" href="<?php echo esc_url( admin_url( 'themes.php?page=about-hm-theme' ) ); ?>"><?php _e( 'Get Started with HybridMag', 'hybridmag' ) ?></a></p>
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

    add_theme_page( esc_html__( 'HybridMag Theme', 'hybridmag' ), $menu_title , 'edit_theme_options', 'about-hm-theme', 'hybridmag_themeinfo_page_render' );

}
add_action( 'admin_menu', 'hybridmag_add_themeinfo_page' );

function hybridmag_themeinfo_page_render() { ?>

    <div class="wrap about-wrap">

        <?php $theme_info = wp_get_theme(); ?>

        <h1><?php esc_html_e( 'Welcome to HybridMag', 'hybridmag' ); ?></h1>

        <p><?php echo esc_html( $theme_info->get( 'Description' ) ); ?></p>

        <?php hybridmag_admin_welcome_page(); ?>

    </div><!-- .wrap .about-wrap -->

    <?php

}

function hybridmag_admin_welcome_page() {
    ?>
    <div class="th-theme-info-page">
        <div class="th-theme-info-page-inner">
            <div class="th-theme-page-infobox">
                <div class="th-theme-infobox-content">
                <h3><?php esc_html_e( 'Theme Customizer', 'hybridmag' ); ?></h3>
                <p><?php esc_html_e( 'All the HybridMag theme settings are located at the customizer. Start customizing your website with customizer.', 'hybridmag' ) ?></p>
                <a class="button" target="_blank" href="<?php echo esc_url( admin_url( '/customize.php' ) ); ?>"><?php esc_html_e( 'Go to customizer','hybridmag' ); ?></a>
                </div>
            </div>

            <div class="th-theme-page-infobox">
            <div class="th-theme-infobox-content">
                <h3><?php esc_html_e( 'Theme Documentation', 'hybridmag' ); ?></h3>
                <p><?php esc_html_e( 'Need to learn all about HybridMag? Read the theme documentation carefully.', 'hybridmag' ) ?></p>
                <a class="button" target="_blank" href="<?php echo esc_url( 'https://themezhut.com/hm-wordpress-theme-documentation/' ); ?>"><?php esc_html_e( 'Read the documentation.','hybridmag' ); ?></a>
            </div>
            </div>

            <div class="th-theme-page-infobox">
            <div class="th-theme-infobox-content">
                <h3><?php esc_html_e( 'Theme Info', 'hybridmag' ); ?></h3>
                <p><?php esc_html_e( 'Know all the details about HybridMag theme.', 'hybridmag' ) ?></p>
                <a class="button" target="_blank" href="<?php echo esc_url( 'https://themezhut.com/themes/hybridmag/' ); ?>"><?php esc_html_e( 'Theme Details.','hybridmag' ); ?></a>
            </div>
            </div>

            <div class="th-theme-page-infobox">
            <div class="th-theme-infobox-content">
                <h3><?php esc_html_e( 'Theme Demo', 'hybridmag' ); ?></h3>
                <p><?php esc_html_e( 'See the theme preview of free version.', 'hybridmag' ) ?></p>
                <a class="button" target="_blank" href="<?php echo esc_url( 'https://themezhut.com/demo/hybridmag/' ); ?>"><?php esc_html_e( 'Theme Preview','hybridmag' ); ?></a>    
            </div>
            </div>
        </div>
    </div>

    <?php
}