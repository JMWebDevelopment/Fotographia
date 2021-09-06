<?php
/**
 * Template part for displaying a post's comment and edit links
 *
 * @package wp_rig
 */

namespace WP_Rig\WP_Rig;

?>

<section class="author-bio clearfix">
	<?php
	if ( get_avatar( esc_url( get_the_author_meta( 'email' ) ) ) ) {
		?>
		<div class="mug-shot">
			<?php echo wp_kses_post( get_avatar( esc_url( get_the_author_meta( 'email' ) ), $size = 96 ) ); ?>
		</div>
		<?php
	}
	if ( esc_attr( get_theme_mod( 'giornalismo-author-position' ) ) ) {
		$position = ', ' . esc_html( get_the_author_meta( 'author-position' ) );
	} else {
		$position = '';
	}
	?>
	<h3 class="title"><?php esc_html_e( 'About ', 'wp-rig' ); ?><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?><?php echo esc_html( $position ); ?></h3>
	<p class="bio"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
</section>
