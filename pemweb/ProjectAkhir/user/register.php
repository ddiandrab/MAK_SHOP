<?php 
	require_once $_SERVER["DOCUMENT_ROOT"]."/pemweb/projectakhir/core/connection.php";
	include "includes/head.php";
	
		$fname = ((isset($_POST["full_name"]))?$_POST["full_name"] : "");
		$birth_date = ((isset($_POST["birth_date"]))?$_POST["birth_date"] : "");
		$no_hp = ((isset($_POST["no_hp"]))?$_POST["no_hp"] : "");
		$email = ((isset($_POST["email"]))?$_POST["email"] : "");
		$password = ((isset($_POST["password"]))?$_POST["password"] : "");
		$md5= md5($password);
?>

<p><br/><br/><br/></p>
    <div class="container">
		<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="panel panel-default panel-body">
				<?php include "helpers/error.php";
		if($_POST){
			$errors = array();
			$dbpath = "";
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
				$insertSql = "INSERT INTO users (full_name, birth_date,no_hp,email,password,image)
					VALUES ('$fname','$birth_date','$no_hp','$email','$md5','$dbpath')";
				$mysqli->query($insertSql);
				header('Location: login.php');
			}
		}
	?>
				<h2 class="form-register-heading">Register</h2></br>
				<form method="post" class="form-register" enctype="multipart/form-data" action="register.php?add=1">
					<div class="form-group">
					<input type="text" name="full_name" class="form-control" placeholder="Full Name" required value=<?=$fname;?>>
					</div>
					<div class="form-group">
					<input type="date" name="birth_date" class="form-control" placeholder="Birth Date (YYYY-MM-DD)" required value=<?=$birth_date;?>>
					</div>
					<div class="form-group">
					<input type="text" name="no_hp" class="form-control" placeholder="Phone Number" required value=<?=$no_hp;?>>
					</div>
					<div class="form-group">
					<input type="text" name="email" class="form-control" placeholder="Email" required value=<?=$email;?>>
					</div>
					<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password" required value=<?=$password;?>>
					</div>
					<div class="form-group">
					<input type="file" name="photo" class="form-control" placeholder="Photo" required>
					</div>
					<button class="btn btn-lg btn-success btn-block" type="submit" name="Login">Register</button>
				</form>
				</div>
			</div>
	</div>
<?php
	include "includes/footer.php";
?>