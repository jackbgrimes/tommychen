import 'magnific-popup';

export default function nav() {
	$( '#header .hamburger' ).on( 'click', function ( e ) {
		e.preventDefault();
		$( this ).toggleClass( 'is-active' );
		$( '#header' ).toggleClass( 'mobile-active' );
		$( '#nav-collapse' ).toggleClass( 'active' );
	} );

	$( '#header .socials>li>a.search' ).on( 'click', function ( e ) {
		e.preventDefault();
		$( 'body' ).toggleClass( 'header-search-open' );
		$( '#s' ).trigger( 'focus' );
	} );

	$( '#header-search a' ).on( 'click', function ( e ) {
		e.preventDefault();
		$( 'body' ).removeClass( 'header-search-open' );
	} );

	// function inverseNav() {
	// 	const pos = $( document ).scrollTop();
	// 	const header = $( '#header' );
	// 	const header_height = header.outerHeight();

	// 	if ( pos > header_height ) {
	// 		header.addClass( 'inverse' );
	// 	} else {
	// 		header.removeClass( 'inverse' );
	// 	}
	// }

	// if ( !$( 'body' ).hasClass( 'single-post' ) && !$( 'body' ).hasClass( 'single-release' ) ) {
	// 	if ( $( 'body' ).hasClass( 'page-template-home' ) ) {
	// 		setTimeout( function () {
	// 			inverseNav();
	// 			$( window ).on( 'scroll', inverseNav );
	// 		}, 1100 );
	// 	} else {
	// 		inverseNav();
	// 		$( window ).on( 'scroll', inverseNav );
	// 	}
	// }


}