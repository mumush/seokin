<div class="editUser">

<h1 class="sectionHeading"><i class="fa fa-user"></i> Account</h1>

	<?php echo $this->Session->flash(); ?>

	<div class="row">

		<div class="col-lg-7 col-lg-offset-3">

			<?php echo $this->Form->create('User'); ?>
			    <fieldset>
			        <?php
				        echo $this->Form->input('username', array('class' => 'form-control input-lg col-sm-2'));

				        //if the user is an employer, require that they enter their password
				        //if an admin, no need to require or even show another users password
				        if( $accessLevel == 2 ) {

				        	echo $this->Form->input('password', array('class' => 'form-control input-lg'));

				        }

				        echo $this->Form->input('email', array('class' => 'form-control input-lg'));
				        echo $this->Form->input('first_name', array('class' => 'form-control input-lg'));
				        echo $this->Form->input('last_name', array('class' => 'form-control input-lg')); ?>
				        <label>Department</label>
				        <?php 
				        	echo $this->Form->input('department_id', array('class' => 'form-control input-lg', 'type' => 'text', 'id' => 'editDeptOptions', 'label' => false));
			    		?>
			    </fieldset>

			    <?php echo $this->Form->submit('Update Info', array('class' => 'btn btn-info btn-lg', 'escape' => false) ); ?>

			<?php echo $this->Form->end(); ?>

			<?php
				echo $this->Html->link('Discard Changes', 
					array('controller' => 'users', 'action' => 'index'), 
					array('class' => 'btn btn-danger btn-lg', 'style' => 'width: 100%;') );
			?>

		</div>

	</div>

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>

<!--Twitter Typeahead JS-->
<?php echo $this->Html->script('typeahead.min'); ?>

<script>

	$('#editDeptOptions').typeahead({
		name: 'accounts',
		prefetch: '../app/webroot/files/depts.json'
	});

</script>

