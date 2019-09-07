<?php
	$mysqli = mysqli_connect('localhost', 'root', '', 'projectakhir');
	
	session_start();
	if(isset($_SESSION["sess_usertype"])){
		$user_id = $_SESSION["sess_user_id"];
		$query = $mysqli->query("SELECT * FROM users WHERE id = '$user_id'");
		$user_data = mysqli_fetch_assoc($query);

	}
?>