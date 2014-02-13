<!DOCTYPE html>
<html lang="en">

	<head>

		<title>SEOkin | </title>

		<!--Twitter Bootstrap 3-->
		<?php echo $this->Html->css('bootstrap'); ?>

		<?php echo $this->Html->css('seokin'); ?>

		<!--FontAwesome-->
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

		<!--Custom Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>

		<link href='http://fonts.googleapis.com/css?family=Raleway:100,300|Roboto:400,300' rel='stylesheet' type='text/css'>

	</head>

	<body class='loginRegister'>

		<!--START OF: Login Form-->

		<div class='container text-center'>

			<div class='content'>

				<div class='row'>

					<div>

						<div class="seokinLoginHeader">
							<h1>SEOkin</h1>
							<?php echo $this->Html->image('rit_tiger.png', array('alt' => 'SEOkin', 'height' => '100', 'style' => 'opacity: .75;')); ?>
							<!--<img src="webroot/img/rit_tiger.png" height="100" style="opacity: .75;"/> -->
							<h4>The RIT - Employer Connection</h4>
						</div>

						<!-- Here's where I want my views to be displayed -->
						<?php echo $this->fetch('content'); ?>

					</div>

				</div>

			</div> <!--END OF: Login Form-->

		</div>


	</body>

</html>