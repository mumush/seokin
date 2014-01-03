<!DOCTYPE html>
<html lang="en">

	<head>

		<title>SEOkin | </title>

		<!--Twitter Bootstrap 3-->
		<?php echo $this->Html->css('bootstrap'); ?>

		<!--FontAwesome-->
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

		<!--Google Web Fonts-->
		<link href='http://fonts.googleapis.com/css?family=Raleway:100,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>

	</head>
	
	<body>

		<nav class="navbar navbar-default" role="navigation">
		  <!-- Brand and toggle get grouped for better mobile display -->
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		      <span class="sr-only">Toggle navigation</span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="#">Seokin</a>
		  </div>

		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    <ul class="nav navbar-nav">
		      <li class="active"><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>
		      <li><a href="#"><i class="fa fa-list-alt"></i> Description</a></li>
		      <li><a href="#"><i class="fa fa-sign-in"></i> Postings</a></li>
		      <li><a href="#"><i class="fa fa-users"></i> Employers</a></li>
		      <li><a href="#"><i class="fa fa-cog"></i> Account</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="#"><i class="fa fa-user"></i> Logout</a></li>
		    </ul>
		  </div><!-- /.navbar-collapse -->
		</nav>

		<div class="container">
			<div class="row">

				<div class="col-lg-12">

					<!-- Here's where I want my views to be displayed -->
					<?php echo $this->fetch('content'); ?>

				</div>

			</div>
		</div>


		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery.js"></script>

		<!--Twitter Bootstrap 3 JS-->
		<?php echo $this->Html->script('bootstrap.min'); ?>

	</body>
</html>