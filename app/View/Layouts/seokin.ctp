<!DOCTYPE html>
<html lang="en">

	<head>

		<title>SEOkin | </title>

		<!--Twitter Bootstrap 3-->
		<?php echo $this->Html->css('bootstrap'); ?>

		<!--SEOkin Stylesheet-->
		<?php echo $this->Html->css('seokin'); ?>

		<!--FontAwesome-->
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

		<!--Google Web Fonts-->
		<link href='http://fonts.googleapis.com/css?family=Raleway:100,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>

	</head>
	
	<body>

		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		  <!-- Brand and toggle get grouped for better mobile display -->
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		      <span class="sr-only">Toggle navigation</span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="#">
		    	<?php echo $this->Html->image('rit_icon.png', array('alt' => 'Seokin', 'id' => 'brandLogo', 'style' => 'opacity: .85;')); ?> Seokin
		    </a>

		  </div>


		  <!--<a id="descripsNav" href="#"><span class="glyphicon glyphicon-list"></span> Descriptions</a>-->

		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    <ul class="nav navbar-nav">
			      <li class="active"><a id="dashNav" href="#"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
			      <li>
					<?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span> Descriptions', 
					array('controller' => 'descriptions', 'action' => 'index'), array('escape' => false, 'id' => 'descripsNav') ); ?>
				  </li>	
			      <li><a id="newdescripNav" href="#"><span class="glyphicon glyphicon-pushpin"></span> Postings</a></li>
			      <li><a id="postingsNav" href="#"><span class="glyphicon glyphicon-user"></span> Employers</a></li>
			      <li><a id="positionsNav" href="#"><span class="glyphicon glyphicon-cog"></span> Account</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li>
		      	<?php echo $this->Html->link('<span class="glyphicon glyphicon-off"></span> Logout', 
		      	array('controller' => 'users', 'action' => 'logout'), array('escape' => false) ); ?>
		      </li>
		    </ul>
		  </div><!-- /.navbar-collapse -->
		</nav>

		<div class="container">
			<div class="row" style="margin-top: 100px;">

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