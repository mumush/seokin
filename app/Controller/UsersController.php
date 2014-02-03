<?php

class UsersController extends AppController {

    public $name = 'Users';

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    /* AUTHENTICATION */

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('register', 'logout');

        //get the user row in the Users table based on the cached id in session
        $user = $this->User->findById( $this->Auth->user('id') );
        //get the access level from the logged in user
        $accessLevel = $user['User']['access_id'];

        $this->set('accessLevel', $accessLevel);

    }

    public function login() {

        $this->layout = 'loginregister';

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect( array('controller' => 'descriptions', 'actions' => 'index') );
            }
            $this->Session->setFlash(__('Invalid username or password'), 'danger_message');
        }
    }

    public function logout() {

        return $this->redirect($this->Auth->logout());
    }

    public function register() {

        $this->layout = 'loginregister';


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
                $this->Session->setFlash(__(  '<strong>' . $this->request->data['User']['username'] . '</strong> has been registered and can now access the system!'), 'success_message');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The employer could not be registered. Please, try again!'), 'danger_message');
        }

        $userOptions = $this->User->find('list');
        //$this->set( 'userOptions', $userOptions );

    }

    /* END AUTHENTICATION */


    /* BAKED CAKEPHP USER CODE */

    public function index() {

        $this->layout = 'seokin';

        $this->User->recursive = 0;
        $this->set('users', $this->paginate());

    }

    public function view($id = null) {

        $this->layout = 'seokin';

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {

        if ( $this->Auth->loggedIn() ) {
            $this->layout = 'seokin';
        }
        else {
            $this->layout = 'loginregister';
        }


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

                $this->Session->setFlash(__( '<strong>' . $this->request->data['User']['username'] . '</strong> has been registered and can now access the system!'), 'success_message');

                //$this->Session->setFlash(__('My message.'), 'flash_notification');

                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The employer could not be added. Please, try again!'), 'danger_message');
        }

        $userOptions = $this->User->find('list');
        //$this->set( 'userOptions', $userOptions );

    }

    public function edit( $id = null ) {

        $this->layout = 'seokin';

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

                $this->Session->setFlash(__(  '<strong>' . $this->request->data['User']['username'] . "'s</strong>" . ' account information has been saved!'), 'info_message');

                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __( '<strong>' . $this->request->data['User']['username'] . "'s</strong>" . ' account information could not be saved. Please, try again!'), 'danger_message');
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

        $this->layout = 'seokin';
        
        //$this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('Employer deleted!'), 'success_message');

            //$this->Session->setFlash('User deletedgheruirge', array('class' => 'alert alert-info') );

            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Employer was not deleted!'), 'danger_message');
        return $this->redirect(array('action' => 'index'));
    }

    public function promote($id = null) {

        $this->layout = 'seokin';

        if ( !$id ) {
            throw new NotFoundException(__('Invalid User'));
        }

        //get the users row based on the id passed in the method
        //if it exists, run the update, otherwise throw an exception
        if ( !($user = $this->User->read(null, $id)) ) {
            throw new NotFoundException(__('Invalid User'));
        }

        //set the users access level to 1 => ADMIN as we are promoting the user
        $this->User->set( array('access_id' => 1) );
        //save the model, update the row in the db
        $this->User->save();

        $this->Session->setFlash(__( $user['User']['username'] . ' has been promoted to Admin!'), 'info_message');

        //redirect to the index controller method
        return $this->redirect(array('action' => 'index'));
    }

    public function demote($id = null) {

        $this->layout = 'seokin';

        if ( !$id ) {
            throw new NotFoundException(__('Invalid User'));
        }

        //get the users row based on the id passed in the method
        //if it exists, run the update, otherwise throw an exception
        if ( !($user = $this->User->read(null, $id)) ) {
            throw new NotFoundException(__('Invalid User'));
        }

        //set the users access level to 2 => EMPLOYER as we are demoting the user
        $this->User->set( array('access_id' => 2) );
        //save the model, update the row in the db
        $this->User->save();

        $this->Session->setFlash(__( $user['User']['username'] . ' has been demoted to Employer!'), 'info_message');

        //redirect to the index controller method
        return $this->redirect(array('action' => 'index'));
    }

}
