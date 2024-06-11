<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HybridMag
 */

?>
	</div><!-- .hm-container -->
	</div><!-- .site-content -->

	<?php
		/**
		 * Before Footer Hook
		 */
		do_action( 'hybridmag_before_footer' ); 
	?>

	<footer id="colophon" class="site-footer">

		<?php
			$hybridmag_footer_sidebar_count = get_theme_mod( 'hybridmag_footer_sidebar_count', '3' );
		?>

		<div class="hm-footer-widget-area">
			<div class="hm-container hm-footer-widgets-inner">
				<div class="hm-footer-column">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div><!-- .hm-footer-column -->

				<?php if ( $hybridmag_footer_sidebar_count >= 2 ) : ?>
					<div class="hm-footer-column">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div><!-- .hm-footer-column -->
				<?php endif; ?>

				<?php if ( $hybridmag_footer_sidebar_count >= 3 ) : ?>
					<div class="hm-footer-column">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div><!-- .hm-footer-column -->
				<?php endif; ?>

				<?php if ( $hybridmag_footer_sidebar_count >= 4 ) : ?>
					<div class="hm-footer-column">
						<?php dynamic_sidebar( 'footer-4' ); ?>
					</div><!-- .hm-footer-column -->
				<?php endif; ?>
			</div><!-- .hm-footer-widgets-inner -->
		</div><!-- .hm-footer-widget-area -->

		<div class="hm-footer-bottom">
			<div class="hm-container hm-footer-site-info">
				<div class="hm-footer-copyright">
					<?php 
						$hybridmag_copyright_text = get_theme_mod( 'hybridmag_footer_copyright_text', '' ); 

						if ( ! empty( $hybridmag_copyright_text ) ) {
							echo wp_kses_post( $hybridmag_copyright_text );
						} else {
							$hybridmag_site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" >' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
							/* translators: 1: Year 2: Site URL. */
							printf( esc_html__( 'Copyright &#169; %1$s %2$s.', 'hybridmag' ), date_i18n( 'Y' ), $hybridmag_site_link ); // WPCS: XSS OK.
						}		
					?>
				</div><!-- .hm-footer-copyright -->

				<div class="hm-designer-credit">
					<?php
						/* translators: 1: WordPress 2: Theme Author. */
						printf( esc_html__( 'Powered by %1$s and %2$s.', 'hybridmag' ),
							'<a href="https://wordpress.org" target="_blank">WordPress</a>',
							'<a href="https://themezhut.com/themes/hybridmag/" target="_blank">HybridMag</a>'
						); 
					?>
				</div><!-- .hm-designer-credit" -->
			</div><!-- .hm-container -->
		</div><!-- .hm-footer-bottom -->
	</footer><!-- #colophon -->

	<?php
		/**
		 * After Footer hook
		 */
		do_action( 'hybridmag_after_footer' ); 
	?>

</div><!-- #page -->

<?php
get_template_part( 'template-parts/mobile', 'sidebar' );
get_template_part( 'template-parts/desktop', 'sidebar' );
?>

<?php wp_footer(); ?>

</body>
</html>
