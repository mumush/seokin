<?php

class DepartmentsController extends AppController {

    public $helpers = array('Html', 'Form');

    public function index() {

        $this->set('depts', $this->Department->find('all'));

    }

}