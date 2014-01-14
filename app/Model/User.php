<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

	//create schema relationship between this table and the Department table
	public $belongsTo = 'Department';

    public $hasMany = 'Description';


    //set up validation rules for new user registration
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Password is required'
            )
        ),
        'first_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'First Name is required'
            )
        ),
        'last_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Last Name is required'
            )
        ),
        'department_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please enter a department'
            )
        )

    );

    /* Every time user is saved, the password is hashed using the above
    SimplePasswordHasher class */
	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new SimplePasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}




}