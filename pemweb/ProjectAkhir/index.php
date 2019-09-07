<?php 
	require "core/connection.php";
	include "includes/head.php";
	include "includes/navbar.php"; 
	
	$sql = "SELECT * FROM products WHERE featured = 1";
	$featured = $mysqli->query($sql);
	$featured2 = $mysqli->query($sql);
?> 
	
	<!-- header -->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			<li data-target="#carousel-example-generic" data-slide-to="3"></li>
		</ol>
	  <!-- Wrapper for slides -->
		
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="img/welcome.jpg" alt="slider1">
				<div class="carousel-caption">
					Mak Shop
				</div>
			</div>
			<?php while($products = mysqli_fetch_assoc($featured2)) :?>
			<div class="item">
				<img src="<?= $products["image"]; ?>" alt="slider1">
				<div class="carousel-caption">
					<?= $products["title"]; ?>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
		
	  <!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	
	<!-- main content -->
	<div class="col-md-8 col-md-offset-1 index-page">
		<h1 class="text-center">Recents Products</h1><hr>
		<?php while($product = mysqli_fetch_assoc($featured)) :?>
			<div class="col-md-3 text-center ">
				<h4><?= $product["title"]; ?></h2>
				<img src="<?= $product["image"]; ?>" alt="<?= $product["title"]; ?>" class="img-responsive">
				<p class="list-price text-danger">List Price: <s>Rp <?= $product["list_price"]; ?></s></p>
				<p class="price">Our Price: Rp <?= $product["price"]; ?></p>
				<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#details1">
					Details
				</button>
			</div>
		<?php endwhile; ?>	
	</div>
	<?php 
		include "includes/sidebar.php";
		include "includes/details.php";
		include "includes/footer.php";
	?>
	
