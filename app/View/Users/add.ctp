
<div class="users form">

	<?php echo $this->Form->create('User'); ?>
	    <fieldset>
	        <legend><?php echo __('Add User'); ?></legend>
	        <?php
		        echo $this->Form->input('username');
		        echo $this->Form->input('password');
		        echo $this->Form->input('first_name');
		        echo $this->Form->input('last_name');
		        echo $this->Form->input('dept_id');

		        //need to add their access level, default = user

		        ?>

		        <input type='text' name="deptOptions" id="deptOptions" />

		        <?

	    	?>
	    </fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>


</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>

<!--Twitter Typeahead JS-->
<?php echo $this->Html->script('typeahead.min'); ?>

<script>

	var web_url = '<?php echo WEBROOT_DIR; ?>';

	$('#deptOptions').typeahead({
		name: 'accounts',
		prefetch: '/app/webroot/files/depts.json'
	});


</script>

