<?php	
	require_once $_SERVER["DOCUMENT_ROOT"]."/pemweb/projectakhir/core/connection.php";
	include "includes/admin-head.php";
	include "includes/admin-navbar.php";
	include "helpers/error.php";
	
	$type = $_SESSION['sess_usertype'];
    if(!isset($_SESSION['sess_email']) || $type!="admin"){
      header('Location: login.php?err=2');
    }
	
	$userQuery = $mysqli->query("SELECT * FROM users WHERE type = 'member' ORDER BY full_name");
	
	if(isset($_GET["delete"])) {
		$id = (int)$_GET["delete"];
		$dsql = "DELETE FROM users WHERE id = '$id'";
		$mysqli->query($dsql);
		header("Location: admin-user.php");
	}
?>

<div class="container products-page">
	<h1 class="text-center">Members</h1>
	<hr>
	<table class="table table-bordered table-condensed table-striped">
		<thead>
			<th></th>
			<th>Full Name</th>
			<th>Birth Date</th>
			<th>Phone Number</th>
			<th>Email</th>
			<th>Photo</th>
		</thead>
		
		<?php while($users = mysqli_fetch_assoc($userQuery)) :?>
			<tr>
				<td>
				<?php 
				$saved_image = (($users["image"] != "")?$users["image"] : $users["image"]);
				
				?>
					<a href="admin-user.php?delete=<?=$users["id"]; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
				<td><?= $users["full_name"]; ?></td>
				<td><?= pretty_date($users["birth_date"]); ?></td>
				<td><?= $users["no_hp"];?></td>
				<td><?= $users["email"];?></td>
				<td class="text-center">
					<div class="saved-image">
					<img src="<?=$saved_image;?>">
				</td>
			</tr>
		<?php endwhile; ?>
	</table>
</div>


<?php
	include "includes/footer.php";
?>