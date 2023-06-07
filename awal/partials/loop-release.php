<?php
$external_url       = get_field( 'external_url' );
$url                = ! empty( $external_url ) ? $external_url : get_the_permalink();
$target             = ! empty( $external_url ) ? '_blank' : '';
$toggle_gray_border = get_field( 'toggle_gray_border' );
$extra_class        = ! empty( $toggle_gray_border ) ? 'gray-border' : '';
$offset             = ! empty( $offset ) ? $offset : 0;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $extra_class ); ?> target="<?php echo esc_attr( $target ); ?>"
         data-aos="fade-up" data-aos-delay="<?php echo esc_attr( $offset ); ?>">
	<a href="<?php echo esc_url( $url ); ?>">
		<?php the_post_thumbnail( 'large' ); ?>
	</a>
</article>