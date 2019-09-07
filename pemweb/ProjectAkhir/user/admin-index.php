<?php 
	require_once $_SERVER["DOCUMENT_ROOT"]."/pemweb/projectakhir/core/connection.php";
	include "includes/admin-head.php";
	include "includes/admin-navbar.php";
	
    $type = $_SESSION['sess_usertype'];
    if(!isset($_SESSION['sess_email']) || $type!="admin"){
      header('Location: login.php?err=2');
    }
?>

<div class="container products-page">
	<h1 class="text-center">WELCOME TO ADMIN PAGE</h1>
	<hr>