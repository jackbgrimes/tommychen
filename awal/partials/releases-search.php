<div class="releases-search">
	<div>
		<?php
		$search = sanitize_text_field( $_GET['search'] );
		?>
		<form action="<?php the_permalink(); ?>" method="GET" class="search-form">
			<label for="search" class="sr-only"><?php esc_html_e( 'Search', 'awal' ); ?></label>
			<input type="search" name="search" id="search" placeholder="<?php esc_attr_e( 'Search',
				'awal' ); ?>" value="<?php echo esc_attr( $search ); ?>"/>
			<a href="<?php echo esc_url( get_permalink( 13 ) ); ?>" class="search-clear">
				<i class="fa fa-times" aria-hidden="true"></i>
				<span class="sr-only"><?php esc_html_e( 'Clear', 'awal' ); ?></span>
			</a>
			<button type="submit">
				<i class="fa fa-search" aria-hidden="true"></i>
				<span class="sr-only"><?php esc_html_e( 'Search', 'awal' ); ?></span>
			</button>
		</form>
	</div>
	<div class="release-sort">
		<?php
		$sort_by = sanitize_text_field( $_GET['sort_by'] );
		?>
		<label for="sort_by"><?php esc_html_e( 'Sort By:', 'awal' ); ?></label>
		<select id="sort_by">
			<option
				value="newest_to_oldest" <?php selected( $sort_by, 'newest_to_oldest' ); ?>><?php esc_html_e( 'Newest to Oldest', 'awal' ); ?></option>
			<option
				value="oldest_to_newest" <?php selected( $sort_by, 'oldest_to_newest' ); ?>><?php esc_html_e( 'Oldest to Newest', 'awal' ); ?></option>
		</select>
	</div>
</div>