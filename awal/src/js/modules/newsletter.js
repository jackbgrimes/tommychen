import 'magnific-popup';
import Cookies from 'js-cookie';

export default function newsletter() {

	const newsletter_viewed = Cookies.get( 'milan_newsletter' );
	if ( !newsletter_viewed ) {
		$.magnificPopup.open( {
			items: {
				src: '#newsletter-modal',
				type: 'inline'
			}
		} );
		Cookies.set( 'milan_newsletter', true, { expires: 7 } );
	}

	$( '.newsletter-link' ).on( 'click', function ( e ) {
		e.preventDefault();
		$.magnificPopup.open( {
			items: {
				src: '#newsletter-modal',
				type: 'inline'
			}
		} );
	} );
}