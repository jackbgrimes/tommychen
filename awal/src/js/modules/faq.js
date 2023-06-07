export default function() {
  $('body').on('click', '.faq-title', function() {
    $(this).closest('li').toggleClass('open');
    if (!$(this).closest('li').hasClass('open')) {
      $(this).next().slideUp();
    } else {
      $(this).next().slideDown();
    }
  });
}