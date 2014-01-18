<?php

class Description extends AppModel {

	public $name = 'Description';

	public $belongsTo = array('User', 'Department');

	public $hasOne = array('Contact');

}