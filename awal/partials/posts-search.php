<?php
$search = sanitize_text_field( $_GET['search'] );
?>
<form action="<?php the_permalink(); ?>" method="GET" class="search-form">
	<label for="search" class="sr-only"><?php esc_html_e( 'Search', 'awal' ); ?></label>
	<input type="search" name="search" id="search" placeholder="<?php esc_attr_e( 'Search',
		'awal' ); ?>" value="<?php echo esc_attr( $search ); ?>"/>
	<a href="<?php echo esc_url( get_permalink( 15 ) ); ?>" class="search-clear">
		<i class="fa fa-times" aria-hidden="true"></i>
		<span class="sr-only"><?php esc_html_e( 'Clear', 'awal' ); ?></span>
	</a>
	<button type="submit">
		<i class="fa fa-search" aria-hidden="true"></i>
		<span class="sr-only"><?php esc_html_e( 'Search', 'awal' ); ?></span>
	</button>
</form>