$(document).ready(function() {
	var currCard = 0;
	var minIndex = 0;
	var maxIndex = $('.card').length - 1;
	//defult page should display the first card
	$('div.card:eq(' + currCard + ')').removeClass('hidden');
	
	//when flip card button is clicked card flips
	$('#flip_card').click(function() {
		$('div.card:visible').children('p').toggleClass('hidden');
	});
	
	//when forward arrow is click display next card
	$('#forward').click(function() {
		if(currCard < maxIndex) {
			$('.question').removeClass('hidden');
			$('.answer').addClass('hidden');
			$('div.card:visible').addClass('hidden');
			currCard++;
			$('div.card:eq(' + currCard + ')').removeClass('hidden');
		}
	});
	
	//when back arrow is clicked display previous card
	$('#back').click(function() {
		if(currCard > minIndex) {
			$('div.card:visible').addClass('hidden');
			currCard--;
			$('div.card:eq(' + currCard + ')').removeClass('hidden');
		}
	});
	
	$('#up_vote').click (function() {
		$.post('ajax.php', 
		{
			task : 'change_rating',
			vote : 'up_vote',
			id : $('div.card:visible').attr('id')
		}, 
		function(data) {
			var rating = jQuery.parseJSON(data);
			$('#curr_rating').html(rating['rating']);
		});
	});
	
	$('#down_vote').click (function() {
		$.post('ajax.php', 
		{
			task : 'change_rating',
			vote : 'down_vote',
			id : $('div.card:visible').attr('id')
		}, 
		function(data) {
			var rating = jQuery.parseJSON(data);
			$('#curr_rating').html(rating['rating']);
		});
	});
}); 