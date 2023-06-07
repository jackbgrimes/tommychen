export default function releases_search() {
	/*$( '.releases-search .search-clear' ).on( 'click', function ( e ) {
		e.preventDefault();
		$( '.releases-search .search-form input' ).val( '' );
	} );*/

	$( '.release-sort>select' ).on( 'change', function ( e ) {
		e.preventDefault();
		const search_form = $( '.search-form' );
		const val = $( this ).val();

		search_form.append( '<input type="hidden" name="sort_by" value="' + val + '" />' );
		search_form.submit();
	} );
}