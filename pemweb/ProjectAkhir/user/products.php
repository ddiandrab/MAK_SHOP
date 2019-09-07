<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/pemweb/projectakhir/core/connection.php";
	include "includes/head.php";
	include "includes/navbar.php";
	
	$type = $_SESSION['sess_usertype'];
    if(!isset($_SESSION['sess_email']) || $type!="member"){
      header('Location: login.php?err=2');
    }
	
	if(isset($_GET["add"]) || isset($_GET["edit"])){
		$parentQuery = $mysqli->query("SELECT * FROM categories WHERE parent = 0 ORDER BY cat_name");
		$user_id = $user_data["id"];
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

	?>
	<div class="container products-page">
	<?php include "helpers/error.php";
		if($_POST){
			$errors = array();
			$required = array('title', 'price', 'parent', 'child');
			foreach($required as $field){
				if($_POST[$field] == ""){
					$errors[] = 'All Fileds with Asterisk are Required.';
					break;
				}
			}
			if (!empty($_FILES)) {
				var_dump($_FILES);
				$photo = $_FILES['photo'];
				$name = $photo['name'];
				$nameArray = explode('.',$name);
				$fileName = $nameArray[0];
				$fileExt = $nameArray[1];
				$mime = explode('/',$photo['type']);
				$mimeType = $mime[0];
				$mimeExt = $mime[1];
				$tmpLoc = $photo['tmp_name'];
				$fileSize = $photo['size'];
				$allowed = array('PNG','jpg','jpeg','gif');
				$uploadPath = 'BASEURL'.'projectakhir/img/'.$name;
				$dbpath = '/pemweb/projectakhir/img/'.$name;
				if ($mimeType != 'image') {
					$errors[] = 'The File must be an image.';
				}
				if (!in_array($fileExt, $allowed)) {
					$errors[] = 'The file extension must be png, jpg, jpeg, or gif.';
				}
				if ($fileSize > 15000000) {
					$errors[] ='The file size must be under 15 MB.';
				}
				if ($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')) {
					$errors[] = 'File extension does not match the file.';
				}
			}
			if(!empty($errors)){
				echo display_errors($errors);
			}
			else{
				//upload file and insert into database
				move_uploaded_file($tmpLoc,$uploadPath);
				$insertSql = "INSERT INTO products (user_id, title,price,list_price,categories,image,description)
					VALUES ('$user_id','$title','$price','$list_price','$category','$dbpath','$description')";
					if(isset($_GET["edit"])){
						$insertSql = "UPDATE products SET title = '$title', price = '$price', list_price = '$list_price',
						categories = '$category', image = '$dbpath', description = '$description'
						WHERE id = '$id_edit'";
					} 
				$mysqli->query($insertSql);
				header('Location: products.php');
			}
		}
	?>
		<h2 class="text-center"><?=((isset($_GET["edit"]))?"Edit ":"Add New ");?>Product</h2>
		<hr>
		
		<form action="products.php?<?=((isset($_GET["edit"]))?"edit=".$id_edit :"add=");?>" method="POST" enctype="multipart/form-data">
			<div class="form-group col-md-3">
				<label for="title">Title*:</label>
				<input type="text" name="title" class="form-control" value="<?=$title;?>">
			</div>		
		
			<div class="form-gorup col-md-3">
				<label for="parent">Parent Category*:</label>
				<select class="form-control" id="parent" name="parent">
					<option value=""<?=(($parent == '')?' selected':'');?>></option>
					<?php while($p = mysqli_fetch_assoc($parentQuery)): ?>
						<option value="<?=$p['id'];?>"<?=(($parent == $p['id'])?' selected':'');?>><?=$p['cat_name'];?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="child">Child Category*:</label>
				<select id="child" name="child" class="form-control">
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="price">Price*:</label>
				<input type="text" name="price" id="price" class="form-control" value="<?=$price?>">
			</div>
			<div class="form-group col-md-3">
				<label for="price">List Price:</label>
				<input type="text" name="list_price" id="list_price" class="form-control" value="<?=$list_price;?>">
			</div>
			<div class="form-group col-md-3">
				<label for="photo">Product Photo*:</label>
				<?php if($saved_image != '') :?>
					<div class="saved-image">
						<img src="<?=$saved_image;?>" alt="saved image">
						<a href="products.php?delete_image=1&edit=<?=$id_edit;?>" class="text-danger">Delete Image</a>
					</div>
				<?php else : ?>
					<input type="file" name="photo" id="photo" class="form-control">
				<?php endif; ?>
			</div>
			<div class="form-group col-md-6">
				<label for="description">Description:</label>
				<textarea name="description" class="form-control" rows="10"><?=$description;?></textarea>
			</div>
			<div class="clearifix"></div>
			<div class="form-group pull-right">
				<a href="products.php" class="btn btn-default">Cancel</a>
				<input type="submit" value="<?=((isset($_GET["edit"]))?"Edit ":"Add ");?>Product" class="btn btn-success">
			</div>
			
		</form>
	</div>
	<?php
	}
	else {
	$sql = "SELECT * FROM products";
	$results = $mysqli->query($sql);
	
	if(isset($_GET["featured"])) {
		$id = (int)$_GET["id"];
		$featured = (int)$_GET["featured"];
		$fsql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
		$mysqli->query($fsql);
		header("Location: products.php");
	}
	
	if(isset($_GET["delete"])) {
		$id = (int)$_GET["delete"];
		$dsql = "DELETE FROM products WHERE id = '$id'";
		$mysqli->query($dsql);
		header("Location: products.php");
	}
	
	

?>
<div class="container products-page">
	<h1 class="text-center">Products</h1>
	<hr>
	<div class="row">
		<div class="col-md-5">
				<div class="profile-image">
					<a href=""><img src=<?=$user_data["image"]?>></a>
					<h1><?=$user_data["full_name"]?></h1>
					<h3>is a <?=$user_data["type"]?></h3>
					<div class="list-group">
						<a href="index.php" class="list-group-item">
							Profile
						</a>
						<a href="products.php" class="list-group-item list-group-item-success">Products</a>
					</div>
				</div>
			</div>
		<div class="col-md-7">
		<table class="table table-bordered table-condensed table-striped">
			<thead>
				<th></th>
				<th>Product</th>
				<th>Price</th>
				<th>Category</th>
				<th>Verify</th>
				<th>Sold</th>
			</thead>
			
			<?php while($product = mysqli_fetch_assoc($results)) :
				$childID = $product["categories"];
				$csql = "SELECT * FROM categories WHERE id = '$childID'";
				$cresult = $mysqli->query($csql);
				$child = mysqli_fetch_assoc($cresult);
				$parentID = $child["parent"];
				$psql = "SELECT * FROM categories WHERE id = '$parentID'";
				$presult = $mysqli->query($psql);
				$parent = mysqli_fetch_assoc($presult);
				$category = $parent["cat_name"]. " - " . $child["cat_name"];
			?>
				<tr>
					<td>
						<a href="products.php?edit=<?= $product["id"]; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="products.php?delete=<?= $product["id"]; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
					</td>
					<td><?= $product["title"]; ?></td>
					<td>Rp <?= $product["price"]; ?></td>
					<td><?= $category;?></td>
					<td>
						&nbsp<?=(($product["featured"] == 1)?"Verified":"-");?>
					</td>
					<td>0</td>
				</tr>
			<?php endwhile; ?>
		</table>
		<a href="products.php?add=1" class="btn btn-success pull-right">Add Product</a>
		</div>
	</div>
</div>


<?php
	} include "includes/footer.php";
?>

	
	