import 'magnific-popup';
import 'lazysizes';

import nav from './modules/nav';
import single from './modules/single';
import scroll_to_top from './modules/scroll-top';
import customModal from './modules/custom-modal';
import headerToogleClass from './modules/scrolling';
import blogs from './modules/blogs';
import featuredBlogs from './modules/featured-blog';
import parallax from './modules/parallex';
import faq from './modules/faq';

$( document ).ready( function ( $ ) {
	nav();
	single();
	scroll_to_top();
	customModal();
	headerToogleClass();
	blogs();
	parallax();
	faq();	
	if ($('body').hasClass('single-post')) {
		featuredBlogs();
	}
} );