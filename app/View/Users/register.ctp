
<div id="registerForm">

	<?php echo $this->Form->create('User'); ?>

	    <fieldset>
	        <?php
		        echo $this->Form->input('username', array('label' => false, 'placeholder' => 'Username', 'class' => 'registerInfo') );
		        echo $this->Form->input('password', array('label' => false, 'placeholder' => 'Password', 'class' => 'registerInfo') );
		        echo $this->Form->input('email', array('label' => false, 'placeholder' => 'Email', 'class' => 'registerInfo') );
		        echo $this->Form->input('first_name', array('label' => false, 'placeholder' => 'First Name', 'class' => 'registerInfo') );
		        echo $this->Form->input('last_name', array('label' => false, 'placeholder' => 'Last Name', 'class' => 'registerInfo') );
		        echo $this->Form->input('department_id', array('type' => 'text', 'id' => 'deptOptions', 'label' => false, 'placeholder' => 'Department') );
	    	?>
	    </fieldset>

	    <?php echo $this->Html->link('<i class="fa fa-long-arrow-left"></i>', array('action' => 'login'), array('class' => 'btn btn-success btn-lg', 'escape' => false) ); ?>

	    <?php echo $this->Form->submit('Register', array('class' => 'btn btn-info btn-lg', 'div' => false) ); ?>

	<?php echo $this->Form->end(); ?>

	<?php echo $this->Session->flash(); ?>

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>

<!--Twitter Typeahead JS-->
<?php echo $this->Html->script('typeahead'); ?>

<script>

	$('#deptOptions').typeahead({
		name: 'accounts',
		prefetch: '../app/webroot/files/depts.json'
	});

</script>

