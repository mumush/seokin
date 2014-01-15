<?php

class DescriptionsController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {

        $this->set('descriptions', $this->Description->find('all'));

    }

    public function add() {

        if ($this->request->is('post')) {


        	//add the currently logged in users id to the field in the description
        	$this->request->data['Description']['user_id'] = $this->Auth->user('id');

        	//get the user row in the Users table based on the cached id
        	$user = $this->Description->User->findById( $this->Auth->user('id') );
        	//get the selected users department id foreign key
        	$usersDepartmentId = $user['User']['department_id'];
        	//set the descriptions department id to the same as the users above
			$this->request->data['Description']['department_id'] = $usersDepartmentId;


			//set the descriptions status id initially to 1 -> PENDING
			$this->request->data['Description']['status_id'] = 1;


        	//if the description information from the form was saved to the db
        	//now save the contact with the new description id from previous save
            if ( $this->Description->save($this->request->data) ) {

	        	//given the saved and stored description, use this id for the contacts description_id
	        	$this->request->data['Contact']['description_id'] = $this->Description->id;

            	//save the description
            	$this->Description->Contact->save($this->request->data);

                $this->Session->setFlash(__('Your job description has been saved.'));
                return $this->redirect(array('action' => 'index'));

            }

            $this->Session->setFlash(__('Unable to add your job description.'));
        }
    }


}