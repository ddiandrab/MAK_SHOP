<?php
	require_once $_SERVER["DOCUMENT_ROOT"]."/pemweb/projectakhir/core/connection.php";
	include "includes/admin-head.php";
	include "includes/admin-navbar.php";
	
	$type = $_SESSION['sess_usertype'];
    if(!isset($_SESSION['sess_email']) || $type!="admin"){
      header('Location: login.php?err=2');
    }
	
	$sql = "SELECT * FROM products";
	$results = $mysqli->query($sql);
	
	if(isset($_GET["featured"])) {
		$id = (int)$_GET["id"];
		$featured = (int)$_GET["featured"];
		$fsql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
		$mysqli->query($fsql);
		header("Location: admin-products.php");
	}
	
	if(isset($_GET["delete"])) {
		$id = (int)$_GET["delete"];
		$dsql = "DELETE FROM products WHERE id = '$id'";
		$mysqli->query($dsql);
		header("Location: admin-products.php");
	}
	
?>
<div class="container products-page">
	<h1 class="text-center">Products</h1>
	<hr>
	<table class="table table-bordered table-condensed table-striped">
		<thead>
			<th></th>
			<th>Product</th>
			<th>Price</th>
			<th>Category</th>
			<th>Featured</th>
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
					<a href="admin-products.php?delete=<?= $product["id"]; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
				<td><?= $product["title"]; ?></td>
				<td>Rp <?= $product["price"]; ?></td>
				<td><?= $category;?></td>
				<td>
					<a href="admin-products.php?featured=<?= (($product["featured"] == 0)?"1":"0"); ?>&id=<?= $product["id"]; ?>" class="btn btn-xs btn-default">
						<span class="glyphicon glyphicon-<?= (($product["featured"] == 1)?"minus":"plus"); ?>"></span>
					</a>
					&nbsp<?=(($product["featured"] == 1)?"Recents Product":"");?>
				</td>
				<td>0</td>
			</tr>
		<?php endwhile; ?>
	</table>
</div>


<?php
	include "includes/footer.php";
?>

	
	