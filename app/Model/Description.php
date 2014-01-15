<?php

class Description extends AppModel {

	public $belongsTo = array('User', 'Department');

	public $hasOne = 'Contact';

	//public $hasOne = 'Status';

}