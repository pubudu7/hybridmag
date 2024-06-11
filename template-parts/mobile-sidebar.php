<aside id="hm-mobile-sidebar" class="hm-mobile-sidebar">
	<button class="hm-mobile-menu-toggle">
		<span class="screen-reader-text"><?php esc_html_e( 'Close', 'hybridmag' ); ?></span>
		<?php hybridmag_the_icon_svg( 'close' ); ?>
	</button>

	<?php 
		if ( true === get_theme_mod( 'hybridmag_show_social_mobile_menu', true ) && has_nav_menu( 'social' ) ) {
			hybridmag_social_nav(); 
		}
	?>

	<div class="hm-mobile-menu-main hm-mobile-menu">
		<?php hybridmag_primary_nav_sidebar(); ?>
	</div>

	<?php if ( true === get_theme_mod( 'hybridmag_show_top_nav_on_mobile_menu', false ) && has_nav_menu( 'secondary' ) ) : ?>
		<div class="hm-mobile-menu-secondary hm-mobile-menu">
			<?php hybridmag_secondary_nav_mobile() ?>
		</div>
	<?php endif; ?>

	<?php 
		if ( true === get_theme_mod( 'hybridmag_show_slideout_widgets_on_mobile_menu', false ) ) {
			dynamic_sidebar( 'header-1' );
		} 
	?>
</aside><!-- .hm-mobile-sidebar -->