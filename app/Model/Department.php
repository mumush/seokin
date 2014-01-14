<?php

class Department extends AppModel {

	//create schema relationship between this table and the User table
	public $hasMany = 'User';


}