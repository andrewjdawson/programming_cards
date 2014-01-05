$(document).ready(function() {
	var currCard = 0;
	var minIndex = 0;
	var maxIndex = $(".card").length - 1;
	//defult page should display the first card
	$("div.card:eq(" + currCard + ")").removeClass("hidden");
	
	//when flip card button is clicked card flips
	$("#flip_card").click(function() {
		$("div.card:visible").children("p").toggleClass("hidden");
	});
	
	//when forward arrow is click display next card
	$("#forward").click(function() {
		if(currCard < maxIndex) {
			$(".term").removeClass("hidden");
			$(".answer").addClass("hidden");
			$("div.card:visible").addClass("hidden");
			currCard++;
			$("div.card:eq(" + currCard + ")").removeClass("hidden");
		}
	});
	
	//when back arrow is clicked display previous card
	$("#back").click(function() {
		if(currCard > minIndex) {
			$("div.card:visible").addClass("hidden");
			currCard--;
			$("div.card:eq(" + currCard + ")").removeClass("hidden");
		}
	});
	
	$("#uploader").validate({
        rules: {
            term: {
                required: true
            },
            answer: {
                required: true
            },
			topic: {
				required: true
			}
        }
    });
});