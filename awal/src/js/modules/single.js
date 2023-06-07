export default function single() {
	/*$( window ).on( 'scroll', function ( e ) {
			const img = $( '.art-col img' );
			const post_banner = $( '.post-banner' );
			let post_banner_offset = 0;
			let scroll_top = $( window ).scrollTop();

			if ( post_banner.length > 0 ) {
				post_banner_offset = post_banner.outerHeight( true );
			}

			const padding = $( 'body' ).innerHeight() - $( 'body' ).height();
			const margin = $( '.inner-content' ).outerHeight( true ) - $( '.inner-content>.container' ).height();
			let header_offset = padding + margin;
			const page_content_top = $( '.page-body' ).offset().top;
			const page_content_bottom = page_content_top + $( '.page-body' ).height();

			if ( verge.viewportW() >= 992 ) {
				if ( scroll_top > 0 && scroll_top > page_content_top - header_offset ) {
					if ( scroll_top < page_content_bottom - header_offset - img.outerHeight() ) {
						img.css( 'top', scroll_top - post_banner_offset );
					} else {
						const max = $( '.page-body' ).height() - img.outerHeight();
						img.css( 'top', max );
					}
				} else {
					img.css( 'top', 0 );
				}
			} else {
				img.css( 'top', 0 );
			}
		}
	);*/

	function resize_spotify() {
		$( '.wp-block-columns figure.is-provider-spotify  iframe' ).each( function ( e ) {
			const imgs = $( this ).parents( '.wp-block-columns' ).find( 'img' );
			if ( imgs.length > 0 ) {
				const img = $( imgs[0] );
				$( this ).css( 'height', img.height() );
			}
		} );
	}

	resize_spotify();

	$( window ).on( 'resize', resize_spotify );

}