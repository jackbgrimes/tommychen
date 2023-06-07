<?php
$facebook_url  = get_field( 'facebook_url' );
$twitter_url   = get_field( 'twitter_url' );
$instagram_url = get_field( 'instagram_url' );
$youtube_url   = get_field( 'youtube_url' );
$spotify_url   = get_field( 'spotify_url' );

$_socials = array(
	array(
		'fa_class' => 'fa-facebook',
		'label'    => __( 'Facebook', 'awal' ),
		'url'      => $facebook_url
	),
	array(
		'fa_class' => 'fa-twitter',
		'label'    => __( 'Twitter', 'awal' ),
		'url'      => $twitter_url
	),
	array(
		'fa_class' => 'fa-instagram',
		'label'    => __( 'Instagram', 'awal' ),
		'url'      => $instagram_url
	),
	array(
		'fa_class' => 'fa-youtube-play',
		'label'    => __( 'YouTube', 'awal' ),
		'url'      => $youtube_url
	),
	array(
		'fa_class' => 'fa-spotify',
		'label'    => __( 'Spotify', 'awal' ),
		'url'      => $spotify_url
	),
);
$socials  = array();

foreach ( $_socials as $_social ) {
	if ( ! empty( $_social['url'] ) ) {
		$socials[] = $_social;
	}
}
$offset = ! empty( $offset ) ? $offset : 0;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-aos="fade-up"
         data-aos-delay="<?php echo esc_attr( $offset ); ?>">
	<?php
	if ( has_post_thumbnail() ) {
		?>
		<a href="<?php echo esc_url( add_query_arg( 's', get_the_title(), site_url() ) ); ?>">
			<div class="img">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
		</a>
		<?php
	}
	?>
	<h2><?php the_title(); ?></h2>
	<?php
	if ( ! empty( $socials ) ) {
		?>
		<ul class="socials">
			<?php
			foreach ( $socials as $social ) {
				?>
				<li>
					<a href="<?php echo esc_url( $social['url'] ); ?>" target="_blank">
						<i class="<?php echo esc_attr( 'fa ' . $social['fa_class'] ); ?>" aria-hidden="true"></i>
						<span class="sr-only"><?php echo esc_html( $social['label'] ); ?></span>
					</a>
				</li>
				<?php
			}
			?>
		</ul>
		<?php
	}
	?>
</article>