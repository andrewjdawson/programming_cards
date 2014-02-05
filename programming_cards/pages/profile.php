<?php
	session_start();
	if(isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
	} else {
		header('Location: ../index.php');
	}
	require '../util/functions.php';
	require '../util/profile_util.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Programming Cards</title>
	</head>
	
	<body>
		<h1>Welcome Back <?php echo $username ?></h1>
		<a href='upload.php'>Publish A Card</a> <br />
		<a href='cards.php'>Return to Flash Cards</a>
		<form method='post' action='../api/logout.php' id='logout'>
			<input type='submit' value='Logout'>
			<input type='hidden' name='logout' value='true'>
		</form>
	</body>
</html>