<?php
	function is_valid_signup($link, $username, $password, $comfirm_password) {
		if(strcmp ($password, $comfirm_password) != 0) {
			return FALSE;
		}
		$r = mysqli_query($link, 'SELECT username FROM users WHERE username="'.$username.'"') or die(mysqli_error($link));
		if(mysqli_num_rows($r) > 0) {
			return FALSE;
		}
		return TRUE;
	}
	
	function insert_into_database($link, $username, $password) {
		mysqli_query($link, 'INSERT INTO users (username, password) VALUES ("'.$username.'", "'.$password.'")') or die(mysqli_error($link));
	}
?>