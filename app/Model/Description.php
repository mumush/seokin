<?php

class Description extends AppModel {

	public $belongsTo = 'User';

	public $hasOne = array('Contact', 'Department');

	//public $hasOne = 'Status';

}