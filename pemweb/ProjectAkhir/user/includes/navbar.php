	<!-- navbar -->
	<div class="container">
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
							<img alt="Brand" class="img-responsive img-logo" src="../img/mak.png">
						</a>
					</div>
				</div><!-- coloumn -->
				<div class="col-md-9 col-sm-4 col-xs-12"><!-- desktop, tablet, mobile -->
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						
						<ul class="nav navbar-nav navbar-right menu-top">
							<li><a href="../index.php">HOME</a></li>
							<li class="dropdown">
								<a href="index.php" class="dropdown-toggle" data-toggle="dropdown">Hello <?=$user_data["full_name"]?>!
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="changePass.php">Change Password</a></li>
									<li><a href="logout.php">Log Out</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- coloumn -->
            </div><!-- row -->
		</div>
    </nav>
</div>
