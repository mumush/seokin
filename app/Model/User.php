<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

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