
<div id="loginForm">

	<?php echo $this->Form->create('User'); ?>
	    <fieldset>
	    <?php 
	        echo $this->Form->input('username', array('label' => false, 'placeholder' => 'Username', 'class' => ''));
	        echo $this->Form->input('password', array('label' => false, 'placeholder' => 'Password', 'class' => ''));
	    ?>
	    </fieldset>

	    <?php echo $this->Form->submit('Sign in', array('class' => 'btn btn-success btn-lg', 'div' => false) ); ?>

	    <?php echo $this->Html->link('Register', array('action' => 'register'), array('class' => 'btn btn-info btn-lg') ); ?>

	<?php echo $this->Form->end(); ?>

	<?php echo $this->Session->flash('auth'); ?>

</div>