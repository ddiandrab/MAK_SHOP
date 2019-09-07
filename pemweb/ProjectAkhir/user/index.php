<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/pemweb/projectakhir/core/connection.php";
	include "includes/head.php";
	include "includes/navbar.php";
	include "helpers/error.php";
	
	$type = $_SESSION['sess_usertype'];
    if(!isset($_SESSION['sess_email']) || $type!="member"){
      header('Location: login.php?err=2');
    }
	
	$saved_image = (($user_data["image"] != "")?$user_data["image"] : $user_data["image"]);
	if(isset($_GET["edit"])){
		$full_name = ((isset($_POST["full_name"]) && $_POST["full_name"] != "")?$_POST["full_name"]:"");
		$birth_date = ((isset($_POST["birth_date"]) && $_POST["birth_date"] != "")?$_POST["birth_date"]:""); 
		$no_hp = ((isset($_POST["no_hp"]) && $_POST["no_hp"] != "")?$_POST["no_hp"]:"");
		$email = ((isset($_POST["email"]) && $_POST["email"] != "")?$_POST["email"]:"");
		$saved_image = '';
		$dbpath = '';
		
	if(isset($_GET["edit"])) {
		$id_edit = (int)$_GET["edit"];
		$userResults = $mysqli->query("SELECT * FROM users WHERE id = '$id_edit'");
		$user = mysqli_fetch_assoc($userResults);
		if(isset($_GET["delete_image"])){
			$url = $_SERVER["DOCUMENT_ROOT"].$user["image"];
			echo $url;
			$mysqli->query("UPDATE users SET image = '' WHERE id = '$id_edit'");
			header("Location: index.php?edit=".$id_edit);
		}
		$full_name = ((isset($_POST["full_name"]) && $_POST["full_name"] != "")?$_POST["full_name"]:$user["full_name"]);
		$birth_date = ((isset($_POST["birth_date"]) && $_POST["birth_date"] != "")?$_POST["birth_date"]:$user["birth_date"]);
		$no_hp = ((isset($_POST["no_hp"]) && $_POST["no_hp"] != "")?$_POST["no_hp"]:$user["no_hp"]);
		$email = ((isset($_POST["email"]) && $_POST["email"] != "")?$_POST["email"]:$user["email"]);
		$saved_image = (($user["image"] != "")?$user["image"] : $user["image"]);
		$dbpath = $saved_image;
	}

	?>

	<?php 
		if($_POST){
			$errors = array();
			$required = array('full_name', 'no_hp', 'birth_date', 'email');
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
					if(isset($_GET["edit"])){
						$insertSql = "UPDATE users SET full_name = '$full_name', no_hp = '$no_hp', email = '$email',
						birth_date = '$birth_date', image = '$dbpath'
						WHERE id = '$id_edit'";
					} 
				$mysqli->query($insertSql);
				header('Location: index.php');
			}
		}
	?>
	<div class="container products-page">

	<h1 class="text-center">Profile</h1><hr>
		<div class="row">
			<div class="col-md-5">
				<div class="profile-image">
					<a href=""><img src=<?=$saved_image?>></a>
					<h1><?=$user_data["full_name"]?></h1>
					<h3>is a <?=$user_data["type"]?></h3>
					<div class="list-group">
						<a href="index.php" class="list-group-item list-group-item-success">
							Profile
						</a>
						<a href="products.php" class="list-group-item">Products</a>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<form action="index.php?edit=<?=$user_data["id"];?>" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="full_name">Full Name*:</label>
							<input type="text" name="full_name" class="form-control" value="<?=$user_data["full_name"]?>">
						</div>	
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="birth_date">Birth Date*:</label>
							<input type="text" name="birth_date" class="form-control" value="<?= ($user_data["birth_date"]); ?>">
							
						</div>	
					
						<div class="form-group col-md-6">
							<label for="no_hp">Phone Number*:</label>
							<input type="text" name="no_hp" class="form-control" value="<?=$user_data["no_hp"]?>">
						</div>	
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="email">Email*:</label>
							<input type="text" name="email" class="form-control" value="<?=$user_data["email"]?>">
						</div>	
					</div>
					<div class="clearifix"></div>
					<div class="form-group">
						<input type="submit" value="Edit Profile" class="btn btn-success">
					</div>
					<div class="form-group">
						<a href="index.php" class="btn btn-default">&nbsp&nbsp Cancel &nbsp&nbsp</a>
					</div>
					
				</form>
			
			</div>
		</div>
	</div>
<?php
	}
	else {
	$sql = "SELECT * FROM users";
	$results = $mysqli->query($sql);
	$user = mysqli_fetch_assoc($results);
?>

<div class="container products-page">
	<h1 class="text-center">Profile</h1><hr>
		<div class="row">
			<div class="col-md-5">
				<div class="profile-image">
					<a href=""><img src=<?=$saved_image?>></a>
					<h1><?=$user_data["full_name"]?></h1>
					<h3>is a <?=$user_data["type"]?></h3>
					<div class="list-group">
						<a href="index.php" class="list-group-item list-group-item-success">
							Profile
						</a>
						<a href="products.php" class="list-group-item">Products</a>
					</div>
				</div>
			</div>
			<div class="col-md-7">
					<div class="row">
						<div class="form-group col-md-12">
							<label for="full_name">Full Name*:</label>
							<input type="text" name="full_name" class="form-control" value="<?=$user_data["full_name"]?>" readonly>
						</div>	
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="birth_date">Birth Date*:</label>
							<input type="text" name="birth_date" class="form-control" value="<?= pretty_date($user_data["birth_date"]); ?>" readonly>
							
						</div>	
					
						<div class="form-group col-md-6">
							<label for="no_hp">Phone Number*:</label>
							<input type="text" name="no_hp" class="form-control" value="<?=$user_data["no_hp"]?>" readonly>
						</div>	
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="email">Email*:</label>
							<input type="text" name="email" class="form-control" value="<?=$user_data["email"]?>" readonly>
						</div>	
					</div>
					<div class="clearifix"></div>
					<a href="index.php?edit=<?=$user_data["id"];?>" class="btn btn-success">Edit Profile</a>
			</div>
		</div>
	</div>


<?php
	} include "includes/footer.php";
?>

	
	