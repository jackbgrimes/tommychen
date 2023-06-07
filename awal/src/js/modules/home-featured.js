require( 'owl.carousel' );
import 'magnific-popup';

export default function home_carousel() {
	$( '#home-featured .owl-carousel' ).owlCarousel( {
		items: 3,
		loop: true,
		dots: false,
		nav: true,
		autoWidth: true,
		margin: 70,
		center: true,
		autoplay: true,
		autoplayTimeout: 4000,
		autoplayHoverPause: true,
		smartSpeed: 1000,
		navText: [
			'<i class="fa fa-caret-left" aria-hidden="true"></i><span class="sr-only">Prev</span>',
			'<i class="fa fa-caret-right" aria-hidden="true"></i><span class="sr-only">Next</span>'
		],
		responsive: {
			0: {
				items: 1,
				margin: 0,
				center: false,
				autoWidth: false,
			},
			992: {
				items: 3,
				autoWidth: true,
				margin: 70,
				center: true,

			}
		}
	} );

	$( '#home-featured .owl-carousel a.featured-video' ).magnificPopup( {
		type: 'iframe'
	} );
}