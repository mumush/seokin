<?php

class ContactsController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {

        $this->set('contacts', $this->Contacts->find('all'));

    }

}