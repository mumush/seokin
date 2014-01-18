<?php

class UsersController extends AppController {

    public $name = 'Users';

    /* AUTHENTICATION */

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add', 'logout');
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Invalid username or password'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /* END AUTHENTICATION */


    /* BAKED CAKEPHP USER CODE */

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());

    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {

        if ($this->request->is('post')) {

            //add the default access_id of 2 -> EMPLOYER
            $this->request->data['User']['access_id'] = 2;

            //get the department name entered from the POST variable with name "department_id"
            $deptName = $this->request->data['User']['department_id'];

            //get the department from the Department table given the stored name above
            $dept = $this->User->Department->findByName( $deptName );

            //get the new department id from the above returned department
            $this->request->data['User']['department_id'] = $dept['Department']['id'];

            //Reset the model for saving new data
            $this->User->create();

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }

        $userOptions = $this->User->find('list');
        //$this->set( 'userOptions', $userOptions );

    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {


            //get the department name entered from the POST variable with name "department_id"
            $deptName = $this->request->data['User']['department_id'];

            //get the department from the Department table given the stored name above
            $dept = $this->User->Department->findByName( $deptName );

            //get the new department id from the above returned department
            $this->request->data['User']['department_id'] = $dept['Department']['id'];


            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {

            $this->request->data = $this->User->read(null, $id);

            //get the id of the currently viewed department
            $deptId = $this->request->data['User']['department_id'];

            //access the department row with the above id
            $dept = $this->User->Department->findById( $deptId );

            //set the POST data to the name of the department, NOT the id (the default)
            $this->request->data['User']['department_id'] = $dept['Department']['name'];


            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        $this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

}
