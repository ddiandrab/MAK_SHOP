<?php 
	require_once $_SERVER["DOCUMENT_ROOT"]."/pemweb/projectakhir/core/connection.php";
	include "includes/head.php";
	

?>
<p><br/><br/><br/></p>
    <div class="container">
		<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="panel panel-default panel-body">
				<?php 
					$errors = array(
						1=>"Invalid email or password, Try again",
						2=>"Please login to access this area"
					);
					$error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;
					if ($error_id == 1) {
						echo '<ul class="bg-danger"><li class="text-danger">'.$errors[$error_id].'</li></ul>';
					}elseif ($error_id == 2) {
						echo '<ul class="bg-danger"><li class="text-danger">'.$errors[$error_id].'</li></ul>';
					}
				?>  
				<h2 class="form-signin-heading">Log In</h2></br>
					<form action="authenticate.php" method="POST" role="form">  
						<input type="text" name="email" class="form-control" placeholder="Email" required autofocus><br/>
						<input type="password" name="password" class="form-control" placeholder="Password" required><br/>
						<div class="form-group pull-right">
							<a href="products.php" class="btn btn-default">Cancel</a>
							<input type="submit" value="Log In" class="btn btn-success">
						</div>
						
					</form>
				</div>
			</div>
	</div>

	
<?php
	 include "includes/footer.php";
?>