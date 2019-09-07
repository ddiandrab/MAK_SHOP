<?php 
	require_once $_SERVER["DOCUMENT_ROOT"]."/pemweb/projectakhir/core/connection.php";
	include "includes/head.php";
 
	$email = ((isset($_POST["email"]))?($_POST["email"]): "");
	$password = ((isset($_POST["password"]))?($_POST["password"]): "");
	
 
	$q = mysqli_query($mysqli, "SELECT * FROM users WHERE email='$email' AND password=md5('$password')");
	$count = mysqli_num_rows($q);

	if($count == 0){
		header('Location: login.php?err=1');
	
	}else{
		$row = mysqli_fetch_array($q);

		session_regenerate_id();
			$_SESSION['sess_user_id'] = $row['id'];
			$_SESSION['sess_email'] = $row['email'];
			$_SESSION['sess_password'] = $row['password'];
			$_SESSION['sess_usertype'] = $row['type'];

			echo $_SESSION['sess_usertype'];
		
		session_write_close();

		if( $_SESSION['sess_usertype'] == "admin"){
			header('Location: admin-index.php');
		
		}else{
			header('Location: index.php');
		}
	}


?>