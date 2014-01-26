$(document).ready(function() {
	var currCard = 0;
	var minIndex = 0;
	var maxIndex = $('.card').length - 1;
	//defult page should display the first card
	$('div.card:eq(' + currCard + ')').removeClass('hidden');
	echo_rating();
	
	//when dropdown menu value is changed submit the form
	$('#topic_selector_dropdown').change(function() {
		var test = $(this).val();
		if(test != 'select') {
			this.form.submit();
		}
	});
	
	//when flip card button is clicked card flips
	$('#flip_card').click(function() {
		$('div.card:visible').children('pre').toggleClass('hidden');
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
		echo_rating();
	});
	
	//when back arrow is clicked display previous card
	$('#back').click(function() {
		if(currCard > minIndex) {
			$('div.card:visible').addClass('hidden');
			currCard--;
			$('div.card:eq(' + currCard + ')').removeClass('hidden');
		}
		echo_rating();
	});
	
	//when upvote button is clicked increment the rating in the database and increment the display value of rating
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
	
	//when downvote button is clicked decrement the rating in the database and decrement the display value of rating
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
	
	//populates the rating display div with the rating of the currently visiable card
	function echo_rating() {
		$.post('ajax.php', 
		{
			task : 'show_rating',
			id : $('div.card:visible').attr('id')
		}, 
		function(data) {
			var rating = jQuery.parseJSON(data);
			$('#curr_rating').html(rating['rating']);
		});
	}
}); 