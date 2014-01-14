


<h3>Description Information</h3>

<div style="float: left; margin-right: 10%;">

<?php
	echo $this->Form->create('Description');

	echo $this->Form->input('title');
	echo $this->Form->input('location');
	echo $this->Form->input('essential_tasks');
	echo $this->Form->input('nonessential_tasks');
	echo $this->Form->input('quals_req');
	echo $this->Form->input('quals_pref');
	echo $this->Form->input('start_date');
	echo $this->Form->input('end_date');
	echo $this->Form->input('hrs_per_week');
	echo $this->Form->input('shift_days');
	echo $this->Form->input('shift_start_time');
	echo $this->Form->input('shift_end_time');
	echo $this->Form->input('wage');
	echo $this->Form->input('flexible');

	?>

</div>

	<br /><br />

	<h3>Contact Information</h3>

<div style="float: left;">

	<?php

	echo $this->Form->input('Contact.name');
	echo $this->Form->input('Contact.email');
	echo $this->Form->input('Contact.phone');
	echo $this->Form->input('Contact.fax');
	echo $this->Form->input('Contact.show_phone', array('type' => 'checkbox') );
	echo $this->Form->input('Contact.show_email', array('type' => 'checkbox') );


	echo $this->Form->input('admin_notes');


	echo $this->Form->end('Save Description');

	?>

</div>


