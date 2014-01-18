<?php

class ContactsController extends AppController {

	public $name = 'Contacts';

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {

        $this->set('contacts', $this->Contacts->find('all'));

    }

}