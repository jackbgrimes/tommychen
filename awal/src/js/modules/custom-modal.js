
export default function customModal() {
	function closeCustomModal() {
		$("body").removeClass("no-overflow"), $(".custom-modal").fadeOut(), $(".custom-modal .video-frame").attr("src", "")
	}
	$(".custom-modal .overlay").on("click", function() {
		closeCustomModal();
	});
}