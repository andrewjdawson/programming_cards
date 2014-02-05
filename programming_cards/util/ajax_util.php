<?php
	//increments or decrements the rating of the currently visiable card
	//increase or decrease is based on if upvote or downvote is set as the vote
	function change_rating($link, $id) {	
		if(isset($_POST['vote']) && $_POST['vote'] == 'up_vote') {
			mysqli_query($link, "UPDATE cards SET rating = rating + 1 WHERE id = $id") or die(mysqli_error($link));
			$q = mysqli_query($link, "SELECT rating FROM cards WHERE id = $id") or die(mysqli_error($link));
			//echo the sql object that is returned from the update statement sends as json
			while($row = mysqli_fetch_array($q)) {
				echo json_encode($row);
			}
		} elseif(isset($_POST['vote']) && $_POST['vote'] = 'down_vote') {
			mysqli_query($link, "UPDATE cards SET rating = rating - 1 WHERE id = $id") or die(mysqli_error($link));
			$q = mysqli_query($link, "SELECT rating FROM cards WHERE id = $id") or die(mysqli_error($link));
			//echo the sql object that is returned from the update statement sends as json
			while($row = mysqli_fetch_array($q)) {
				echo json_encode($row);
			}
		}
	}
	
	//echo the rating of the currently visiable card as json
	function echo_rating($link, $id) {
		$r = mysqli_query($link, "SELECT rating FROM cards WHERE id = $id") or die(mysqli_error($link));
		while($row = mysqli_fetch_array($r)) {
			echo json_encode($row);
		}
	}
?>