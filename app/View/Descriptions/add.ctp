<div class="addDescription">

	<h1 class="sectionHeading"><i class="fa fa-file-text"></i> New Job Description</h1>

	<?php echo $this->Session->flash(); ?>

	<div class="row">

		<div class="col-lg-6">

			<?php
				echo $this->Form->create('Description');

				echo $this->Form->input('title', array('class' => 'form-control span3', 'label' => 'Job Title'));
				echo $this->Form->input('location', array('class' => 'form-control'));
				echo $this->Form->input('start_date', array('class' => 'form-control'));
				echo $this->Form->input('end_date', array('class' => 'form-control'));
				echo $this->Form->input('hrs_per_week', array('class' => 'form-control', 'label' => 'Hours Per Week'));
				echo $this->Form->input('flexible', array('label' => 'Flexible Hours') );
				echo '<br />';
				echo $this->Form->input('shift_days', array('class' => 'form-control'));
				echo $this->Form->input('shift_start_time', array('class' => 'form-control'));
				echo $this->Form->input('shift_end_time', array('class' => 'form-control'));

			?>

		</div>

		<div class="col-lg-6">

			<label style="margin-bottom: 1%;" for="wage">Wage</label>

			<div class="input-group">
				<span class="input-group-addon">$</span>

				<?php echo $this->Form->input('wage', array('id' => 'wage', 'class' => 'form-control', 'label' => false) ); ?>
			</div>

			<br />

			<?php

				$categories = array( 1 => 'Academic', 2 => 'Athletic', 3 => 'Clerical', 4 => 'Computer Technical', 5 => 'Community Service', 
					6 => 'Food Service', 7 => 'Miscellaneous', 8 => 'Maintenance', 9 => 'Services', 10 => 'Telemarketing');
				
				echo $this->Form->input(
				    'category_id',
				    array('options' => $categories, 'empty' => '(Choose one)', 'class' => 'form-control', 'label' => 'Job Category')
				);
				echo '<br />';

				echo $this->Form->input('Contact.name', array('class' => 'form-control', 'label' => 'Contact Name'));
				echo $this->Form->input('Contact.email', array('class' => 'form-control', 'label' => 'Contact Email'));
				echo $this->Form->input('Contact.phone', array('class' => 'form-control', 'label' => 'Contact Phone'));
				echo $this->Form->input('Contact.fax', array('class' => 'form-control', 'label' => 'Contact Fax'));
				echo $this->Form->input('Contact.show_phone', array('type' => 'checkbox') );
				echo $this->Form->input('Contact.show_email', array('type' => 'checkbox') );

				//echo $this->Form->input('admin_notes', array('class' => 'form-control'));

			?>

		</div>

	</div>

	<div class="row" style="margin-top: 3%;">

		<div class="col-lg-12">

			<?php
				echo $this->Form->input('essential_tasks', array('class' => 'form-control'));
				echo $this->Form->input('nonessential_tasks', array('class' => 'form-control'));
				echo $this->Form->input('quals_req', array('class' => 'form-control'));
				echo $this->Form->input('quals_pref', array('class' => 'form-control'));
			?>

		</div>

	</div>

	<div class="row">

		<div class="col-lg-6">

			<?php
			    echo $this->Form->submit('Submit Description', array('class' => 'btn btn-success btn-lg') );

				echo $this->Form->end();
			?>

		</div>

		<div class="col-lg-6">

			<?php
				echo $this->Html->link('Discard Description', 
					array('controller' => 'descriptions', 'action' => 'index'), 
					array('class' => 'btn btn-danger btn-lg') );
			?>

		</div>

	</div>


</div>


<script src="https://code.jquery.com/jquery.js"></script>

<!--Twitter Bootstrap 3 JS-->
<?php echo $this->Html->script('bootstrap.min'); ?>

<script>

	$('#wage').popover( {'trigger': 'focus','placement': 'top','content': '$8.00, $8.10, $8.20, or $8.30+'} );

</script>


