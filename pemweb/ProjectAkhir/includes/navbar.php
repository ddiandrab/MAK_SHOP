	<!-- navbar -->

	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
            <div class="row">
				<div class="col-md-3 col-sm-8 col-xs-12"> <!-- desktop, tablet, mobile -->
                <!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">
							<img alt="Brand" class="img-responsive img-logo" src="img/mak.png">
						</a>
					</div>
				</div><!-- coloumn -->
				<?php
				
					$type = $user_data["type"];
					if($type=="member"){
				?>
				<div class="col-md-9 col-sm-4 col-xs-12"><!-- desktop, tablet, mobile -->
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						
						<ul class="nav navbar-nav navbar-right menu-top">
							<li><a href="index.php">HOME</a></li>
							<li class="dropdown">
								<a href="index.php" class="dropdown-toggle" data-toggle="dropdown">Hello <?=$user_data["full_name"]?>!
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="user/index.php">Profile</a></li>
									<li><a href="changePass.php">Change Password</a></li>
									<li><a href="user/logout.php">Log Out</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
				<?php
					}
					else if($type=="admin"){
				?>
				<div class="col-md-9 col-sm-4 col-xs-12"><!-- desktop, tablet, mobile -->
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						
						<ul class="nav navbar-nav navbar-right menu-top">
							<li><a href="admin-products.php">Products</a></li>
							<li><a href="admin-user.php">Users</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?=$user_data["full_name"]?>!
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="change-password.php">Change Password</a></li>
									<li><a href="user/logout.php">Log Out</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
				<?php
					} else {
				?>
				
				<div class="col-md-9 col-sm-4 col-xs-12"><!-- desktop, tablet, mobile -->
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<form action="search.php" method="get" role="search" class="navbar-form navbar-left">
							<div class="form-group">
								<input type="text" class="form-control form-top" placeholder="Type to search.." autofocus>
							</div>
							<button type="submit" class="btn btn-default btn-link btn-search-top text-btn-top"><span class="glyphicon glyphicon-search"></span></button>
						</form>
						<ul class="nav navbar-nav navbar-right menu-top">
							<li><a href="user/login.php">Log In</a></li>
							<li><a href="user/register.php">Register</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- coloumn -->
				<?php
				} 
				?>
            </div><!-- row -->
		</div>
    </nav>
