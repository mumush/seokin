<?php

class DescriptionsController extends AppController {

	public $name = 'Descriptions';

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');


    public function beforeFilter() {
        parent::beforeFilter();

        $this->layout = 'seokin';

    }


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

			//because the description is initially pending, give it an initial
			//job number of 0 as it is not already a job
			$this->request->data['Description']['number'] = 0;

			//initially set is_posted to FALSE b/c the description is not approved
			//and is not officially a job
			$this->request->data['Description']['is_posted'] = 0;


        	//if the description information from the form was saved to the db
        	//now save the contact with the new description id from previous save
            if ( $this->Description->save($this->request->data) ) {

	        	//given the saved and stored description, use this id for the contacts description_id
	        	$this->request->data['Contact']['description_id'] = $this->Description->id;

            	//save the description
            	$this->Description->Contact->save($this->request->data);

                $this->Session->setFlash(__('Your job description has been added and is currently waiting approval!'), 'info_message');
                return $this->redirect(array('action' => 'index'));

            }

            $this->Session->setFlash(__('Unable to add your job description.'), 'danger_message');
        }
    }

	public function edit( $id = null ) {

	    if (!$id) {
	        throw new NotFoundException(__('Invalid Description'));
	    }

	    $description = $this->Description->findById($id);
	    if (!$description) {
	        throw new NotFoundException(__('Invalid Description'));
	    }

	    if ($this->request->is(array('post', 'put'))) {

	        $this->Description->id = $id;

	        //get the row for the selected description from the db for comparison
			$description = $this->Description->read( null, $this->Description->id );

			//if the status is approved,
			//when edits are made, only return the description to pending unless
			//certain fields are changed
			if( $description['Description']['status_id'] == 2 ) {

				//see if the title, wage, contact name, or any descriptive field has been changed in the edit form
				//if any have, set the status of the description to pending
				//if none have, and other fields have been changed, don't change the status
				if( $description['Description']['title'] != $this->request->data['Description']['title']
					|| $description['Description']['wage'] != $this->request->data['Description']['wage']
					|| $description['Description']['essential_tasks'] != $this->request->data['Description']['essential_tasks']
					|| $description['Description']['nonessential_tasks'] != $this->request->data['Description']['nonessential_tasks']
					|| $description['Description']['quals_req'] != $this->request->data['Description']['quals_req']
					|| $description['Description']['quals_pref'] != $this->request->data['Description']['quals_pref']
					|| $description['Contact']['name'] != $this->request->data['Contact']['name']
				) {

					//set the descriptions status id back to 1 -> PENDING
					//because it has been edited and needs approval
					$this->request->data['Description']['status_id'] = 1;

					//set is_posted back to false as the description needs to
					//again be approved
					$this->request->data['Description']['is_posted'] = 0;

				}
			}

			//if the description isn't approved, ie. its either pending or denied
			//just set its status back to pending regardless of which fields were edited
			else {

				//set the descriptions status id back to 1 -> PENDING
				//because it has been edited and needs approval
				$this->request->data['Description']['status_id'] = 1;

				//set is_posted back to false as the description has
				//been edited and its posted status should be reset for integrity
				$this->request->data['Description']['is_posted'] = 0;

			}


	        if ($this->Description->save($this->request->data)) {

	        	//find the related contact
	        	$contact = $this->Description->Contact->findByDescriptionId( $id );
	        	//update the models contact id such that contact data in the form can be saved
	        	$this->Description->Contact->id = $contact['Contact']['id'];
	        	$this->Description->Contact->save($this->request->data);

	            $this->Session->setFlash(__('Your Description has been updated.'), 'info_message');
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your Description.'), 'danger_message');
	    }

	    if (!$this->request->data) {
	        $this->request->data = $description;
	    }

	}

	public function approve( $id = null ) {

	    if ( !$id ) {
	        throw new NotFoundException(__('Invalid Description'));
	    }

	    //get the description row based on the id passed in the method
	    //if it exists, run the update, otherwise throw an exception
	    if ( !($desc = $this->Description->read(null, $id)) ) {
	    	throw new NotFoundException(__('Invalid Description'));
	    }

    	//set the descriptions necessary hard coded changes because it is now a job
    	//initially set job to not posted
		$this->Description->set( array('status_id' => 2, 'number' => ('number' + 1), 'is_posted' => 0)  );
		//save the model, update the row in the db
		$this->Description->save();

		$this->Session->setFlash(__( '<strong>' . $desc['User']['username'] . "'s</strong> " . 'job description has been approved!'), 'success_message');

		//redirect to the index controller method
	    return $this->redirect(array('action' => 'index'));

	}


	public function deny( $id = null ) {

	    if ( !$id ) {
	        throw new NotFoundException(__('Invalid Description'));
	    }

	    //get the description row based on the id passed in the method
	    //if it exists, run the update, otherwise throw an exception
	    if ( !($desc = $this->Description->read(null, $id)) ) {
	    	throw new NotFoundException(__('Invalid Description'));
	    }

    	//change the descriptions status_id to 3 -> DENIED
		$this->Description->set( array('status_id' => 3) );
		//save the model, update the row in the db
		$this->Description->save();

		$this->Session->setFlash(__( '<strong>' . $desc['User']['username'] . "'s</strong> " . 'job description has been denied!'), 'danger_message');

		//redirect to the index controller method
	    return $this->redirect(array('action' => 'index'));

	}

	//get all of the descriptions where the status is approved, which means the
	//description has been approved and is now considered a job and is initially posted (job posting)
    public function postings() {

		$this->set('descriptions', $this->Description->find('all', array('conditions' => array('status_id' => 2))) );

    }


    //set the descriptions is_posted to 1 meaning posted
    public function repost( $id = null ) {

	    if ( !$id ) {
	        throw new NotFoundException(__('Invalid Description'));
	    }

	    //get the description row based on the id passed in the method
	    //if it exists, run the update, otherwise throw an exception
	    if ( !($desc = $this->Description->read(null, $id)) ) {
	    	throw new NotFoundException(__('Invalid Description'));
	    }

    	//change the descriptions posting status to 1 meaning its posted
		$this->Description->set( array('is_posted' => 1) );
		//save the model, update the row in the db
		$this->Description->save();

		$this->Session->setFlash(__( '<strong>' . $desc['User']['username'] . "'s</strong> " . 'job has been posted!'), 'success_message');

		//redirect to the index controller method
	    return $this->redirect(array('action' => 'postings'));

    }


    //set the descriptions is_posted to 0 meaning NOT posted
    public function unpost( $id = null ) {

	    if ( !$id ) {
	        throw new NotFoundException(__('Invalid Description'));
	    }

	    //get the description row based on the id passed in the method
	    //if it exists, run the update, otherwise throw an exception
	    if ( !($desc = $this->Description->read(null, $id)) ) {
	    	throw new NotFoundException(__('Invalid Description'));
	    }

    	//change the descriptions posting status to 0 meaning its NOT posted
		$this->Description->set( array('is_posted' => 0) );
		//save the model, update the row in the db
		$this->Description->save();

		$this->Session->setFlash(__( '<strong>' . $desc['User']['username'] . "'s</strong> " . 'job is not longer posted!'), 'danger_message');

		//redirect to the index controller method
	    return $this->redirect(array('action' => 'postings'));

    }



}