export default function() {
  $(".blog-list ul li").addClass("hidden")
  $(".blog-list ul > li:lt(5)").removeClass("hidden")
  $(".blog-list .btn-container").show()
  $(".blog-list .show-more").on("click", function() {
    $(".blog-list ul > li.hidden:lt(1)").length && ($(".blog-list ul > li.hidden:lt(5)").removeClass("hidden"), 0 === $(".blog-list ul > li.hidden:lt(1)").length && ($(".blog-list .btn-container .show-more").hide(), $(".blog-list .btn-container .show-more.next-page").show()))
  })
}