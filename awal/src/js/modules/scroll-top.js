export default function scroll_to_top() {
    const offset = 100;
    const scrollLink = $('#back-to-top-link');

    // $(window).scroll(function() {
    //     if ($(this).scrollTop() > 100) {
    //         scrollLink.fadeIn();
    //     } else {
    //         scrollLink.fadeOut();
    //     }
    // });

    scrollLink.on("click", function () {
        $("html, body").scrollTop(0);
    });
}