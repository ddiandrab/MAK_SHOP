<?php
	if(isset($_GET["add"]) || isset($_GET["edit"])){
		$parentQuery = $mysqli->query("SELECT * FROM categories WHERE parent = 0 ORDER BY cat_name");
		$title = ((isset($_POST["title"]) && $_POST["title"] != "")?$_POST["title"]:"");
		$parent = ((isset($_POST["parent"]) && $_POST["parent"] != "")?$_POST["parent"]:"");
		$category = ((isset($_POST["child"]) && $_POST["child"] != "")?$_POST["child"]:""); 
		$price = ((isset($_POST["price"]) && $_POST["price"] != "")?$_POST["price"]:"");
		$list_price = ((isset($_POST["list_price"]) && $_POST["list_price"] != "")?$_POST["list_price"]:"");
		$description = ((isset($_POST["description"]) && $_POST["description"] != "")?$_POST["description"]:"");
		$saved_image = '';
		$dbpath = '';
		
	if(isset($_GET["edit"])) {
		$id_edit = (int)$_GET["edit"];
		$productResults = $mysqli->query("SELECT * FROM products WHERE id = '$id_edit'");
		$product = mysqli_fetch_assoc($productResults);
		if(isset($_GET["delete_image"])){
			$url = $_SERVER["DOCUMENT_ROOT"].$product["image"];
			echo $url;
			$mysqli->query("UPDATE products SET image = '' WHERE id = '$id_edit'");
			header("Location: products.php?edit=".$id_edit);
		}
		$title = ((isset($_POST["title"]) && $_POST["title"] != "")?$_POST["title"]:$product["title"]);
		$category = ((isset($_POST["child"]) && $_POST["child"] != "")?$_POST["child"]:$product["categories"]);
		$parentQ = $mysqli->query("SELECT * FROM categories WHERE id = '$category'");
		$parentResult = mysqli_fetch_assoc($parentQ);
		$parent = ((isset($_POST["parent"]) && $_POST["parent"] != "")?$_POST["parent"]:$parentResult["parent"]);
		$price = ((isset($_POST["price"]) && $_POST["price"] != "")?$_POST["price"]:$product["price"]);
		$list_price = ((isset($_POST["list_price"]) && $_POST["list_price"] != "")?$_POST["list_price"]:$product["list_price"]);
		$description = ((isset($_POST["description"]) && $_POST["description"] != "")?$_POST["description"]:$product["description"]);
		$saved_image = (($product["image"] != "")?$product["image"] : $product["image"]);
		$dbpath = $saved_image;
	}
	