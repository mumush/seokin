<!DOCTYPE html>
<html lang="en">

	<head>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>SEOkin | </title>

		<!--Twitter Bootstrap 3-->
		<?php echo $this->Html->css('bootstrap'); ?>

		<!--SEOkin Stylesheet-->
		<?php echo $this->Html->css('seokin'); ?>

		<!--FontAwesome-->
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

		<!--Google Web Fonts-->
		<link href='http://fonts.googleapis.com/css?family=Raleway:100,300|Roboto:400,300|Roboto+Condensed:400,700,300|Dosis:300,400' rel='stylesheet' type='text/css'>

		<link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>

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

			<?php echo $this->Html->link('Seokin', 
			array('controller' => 'descriptions', 'action' => 'dashboard'), array('escape' => false, 'class' => 'navbar-brand') ); ?>

		  </div>


		  <!--<a id="descripsNav" href="#"><span class="glyphicon glyphicon-list"></span> Descriptions</a>-->

		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    <ul class="nav navbar-nav">
			      <li id="dash" <?php if( $this->params['controller'] == "descriptions" && $this->params['action'] == "dashboard" ) echo 'class="active"'; ?> >
					<?php echo $this->Html->link('<span class="glyphicon glyphicon-home"></span> Dashboard', 
					array('controller' => 'descriptions', 'action' => 'dashboard'), array('escape' => false, 'id' => 'dashNav') ); ?>

					<?php echo $this->Html->link('<span class="glyphicon glyphicon-home"></span>', 
					array('controller' => 'descriptions', 'action' => 'dashboard'), array('escape' => false, 'id' => 'hiddenDash', 
					'data-original-title' => 'Dashboard', 'data-placement' => 'bottom', 'data-toggle' => 'tooltip') ); ?>
				  </li>
			      <li id="descriptions" <?php if( $this->params['controller'] == "descriptions" && $this->params['action'] == "index" ) echo 'class="active"'; ?> >

				      <?php

				      	if( $notifyDescripChanged == true ) {
				      		$notification = '<i class="fa fa-circle notification"></i>';
				      	}
				      	else {
				      		$notification = '';
				      	}

				      ?>


					<?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span> Descriptions ' . $notification , 
					array('controller' => 'descriptions', 'action' => 'index'), array('escape' => false, 'id' => 'descripsNav') ); ?>

					<?php echo $this->Html->link('<span class="glyphicon glyphicon-list"></span>', 
					array('controller' => 'descriptions', 'action' => 'index'), array('escape' => false, 'id' => 'hiddenDescrips', 
					'data-original-title' => 'Descriptions', 'data-placement' => 'bottom', 'data-toggle' => 'tooltip') ); ?>
				  </li>
				  <li id="postings" <?php if( $this->params['controller'] == "descriptions" && $this->params['action'] == "postings" ) echo 'class="active"'; ?> >
					<?php echo $this->Html->link('<span class="glyphicon glyphicon-pushpin"></span> Postings', 
					array('controller' => 'descriptions', 'action' => 'postings'), array('escape' => false, 'id' => 'postingsNav') ); ?>

					<?php echo $this->Html->link('<span class="glyphicon glyphicon-pushpin"></span>', 
					array('controller' => 'descriptions', 'action' => 'postings'), array('escape' => false, 'id' => 'hiddenPostings', 
					'data-original-title' => 'Postings', 'data-placement' => 'bottom', 'data-toggle' => 'tooltip') ); ?>
			      </li>
			      <li id="employers" <?php if( $this->params['controller'] == "users" && $this->params['action'] == "index" ) echo 'class="active"'; ?> >
					<?php echo $this->Html->link('<span class="glyphicon glyphicon-user"></span> Employers', 
					array('controller' => 'users', 'action' => 'index'), array('escape' => false, 'id' => 'employersNav') ); ?>

					<?php echo $this->Html->link('<span class="glyphicon glyphicon-user"></span>', 
					array('controller' => 'users', 'action' => 'index'), array('escape' => false, 'id' => 'hiddenEmployers', 
					'data-original-title' => 'Employers', 'data-placement' => 'bottom', 'data-toggle' => 'tooltip') ); ?>
			      </li>
			      <li id="account" <?php if( $this->params['controller'] == "users" && $this->params['action'] == "edit" ) echo 'class="active"'; ?> >
					<?php echo $this->Html->link('<span class="glyphicon glyphicon-cog"></span> Account', 
					array('controller' => 'users', 'action' => 'edit', AuthComponent::user('id') ), array('escape' => false, 'id' => 'accountNav') ); ?>

					<?php echo $this->Html->link('<span class="glyphicon glyphicon-cog"></span>', 
					array('controller' => 'users', 'action' => 'edit', AuthComponent::user('id') ), array('escape' => false, 'id' => 'hiddenAccount', 
					'data-original-title' => 'Account', 'data-placement' => 'bottom', 'data-toggle' => 'tooltip') ); ?>
			      </li>
			      <li id="faq" <?php if( $this->params['controller'] == "users" && $this->params['action'] == "faq" ) echo 'class="active"'; ?> >
					<?php echo $this->Html->link('<span class="glyphicon glyphicon-question-sign" style="padding-right: 20px;"></span></span> FAQ', 
					array('controller' => 'users', 'action' => 'faq' ), array('escape' => false, 'id' => 'faqNav') ); ?>

					<?php echo $this->Html->link('<span class="glyphicon glyphicon-question-sign" style="padding-right: 20px;"></span></span>', 
					array('controller' => 'users', 'action' => 'faq' ), array('escape' => false, 'id' => 'hiddenFaq', 
					'data-original-title' => 'FAQ', 'data-placement' => 'bottom', 'data-toggle' => 'tooltip') ); ?>
			      </li>

		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li>
		      	<?php echo $this->Html->link('<span class="glyphicon glyphicon-log-out" style="padding-right: 20px;"></span> ' . AuthComponent::user('username'), 
		      	array('controller' => 'users', 'action' => 'logout'), array('escape' => false, 'id' => 'logoutNav') ); ?>

		      	<?php echo $this->Html->link('<span class="glyphicon glyphicon-log-out" style="padding-right: 35px;"></span>', 
		      	array('controller' => 'users', 'action' => 'logout'), array('escape' => false, 'id' => 'hiddenLogout', 
		      	'data-original-title' => 'Logout', 'data-placement' => 'bottom', 'data-toggle' => 'tooltip') ); ?>
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

		    <div class="row footer">

				<div class="col-lg-6">

					<p><a href="http://www.rit.edu/seo">Student Employment Office</a>, 49 Lomb Memorial Drive, Rochester, NY 14623</p>
					<p>Copyright &copy; <a href="http://www.rit.edu/">Rochester Institute of Technology</a>, All Rights Reserved.</p>
					<p>Technical Inquiries Contact <a href="mailto:rhoff37@gmail.com">Ryan Hoffmann</a></p>

				</div>

				<div class="col-lg-2 col-lg-offset-1">

					<p><?php echo $this->Html->link('Dashboard', array('controller' => 'descriptions', 'action' => 'dashboard') ); ?></p>
					<p><?php echo $this->Html->link('Job Descriptions', array('controller' => 'descriptions', 'action' => 'index') ); ?></p>
					<p><?php echo $this->Html->link('Job Postings', array('controller' => 'descriptions', 'action' => 'postings') ); ?></p>

				</div>

				<div class="col-lg-2 col-lg-offset-1">

					<p><?php echo $this->Html->link('Employers', array('controller' => 'users', 'action' => 'index') ); ?></p>
					<p><?php echo $this->Html->link('Account', array('controller' => 'users', 'action' => 'edit', AuthComponent::user('id') ) ); ?></p>
					<p><?php echo $this->Html->link('FAQ', array('controller' => 'users', 'action' => 'faq') ); ?></p>

				</div>

		    </div>


		</div>


		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery.js"></script>

		<!--Twitter Bootstrap 3 JS-->
		<?php echo $this->Html->script('bootstrap.min'); ?>

		<script>

		    $('#hiddenDash').tooltip();
		    $('#hiddenDescrips').tooltip();
		    $('#hiddenPostings').tooltip();
		    $('#hiddenEmployers').tooltip();
		    $('#hiddenAccount').tooltip();
		    $('#hiddenAccount').tooltip();
		    $('#hiddenLogout').tooltip();
		    $('#hiddenFaq').tooltip();

			$('#dashNewUser').tooltip();
			$('#dashNewDesc').tooltip();
			$('#newDescription').tooltip();
			$('#newUser').tooltip();

			$('#wage').popover( {'trigger': 'focus','placement': 'top','content': '$8.00, $8.10, $8.20, or $8.30+'} );

		</script>



	</body>

</html>