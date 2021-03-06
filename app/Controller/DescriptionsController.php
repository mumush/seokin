<?php

class DescriptionsController extends AppController {

	public $name = 'Descriptions';

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');


    public function beforeFilter() {
        parent::beforeFilter();

        if ( $this->Auth->loggedIn() ) {

            //get the user row in the Users table based on the cached id in session
            $user = $this->Description->User->findById( $this->Auth->user('id') );
            //get the access level from the logged in user
            $accessLevel = $user['User']['access_id'];

            $this->set('accessLevel', $accessLevel);


            //admin notes notifications
            //determine if any of the logged in users descriptions have any admin notes
            //if they do, notify the user because the status of one/many of their descriptions
            //may have changed

            $this->Description->User->findById( $this->Auth->user('id') );

    		$conditions = array('Description.user_id' => $user['User']['id'], 'NOT' => array('Description.admin_notes' => '') );

    		if( $this->Description->hasAny($conditions) ) {

    			$notifyDescripChanged = true;
    			$this->set('notifyDescripChanged', $notifyDescripChanged);

    		}

    		else {

				$notifyDescripChanged = false;
				$this->set('notifyDescripChanged', $notifyDescripChanged);  			

    		}


        }

        $this->layout = 'seokin';

    }

    public function dashboard() {

    	//get the user row in the Users table based on the cached id in session
    	$user = $this->Description->User->findById( $this->Auth->user('id') );
    	//get the access level from the logged in user
    	$accessLevel = $user['User']['access_id'];
    	//get the department_id from the logged in user
    	$deptID = $user['User']['department_id'];

    	if( $accessLevel == 2 ) {

    		$pending = $this->Description->find('all', array( 'conditions' => 
    			array('Description.status_id' => 1, 'AND' => array('Description.department_id' => $deptID) ), 'order' => array('Description.id' => 'DESC'), 'limit' => 5 ));

    		$approved = $this->Description->find('all', array( 'conditions' => 
    			array('Description.status_id' => 2, 'AND' => array('Description.department_id' => $deptID) ), 'order' => array('Description.id' => 'DESC'), 'limit' => 5 ));

    		$denied = $this->Description->find('all', array( 'conditions' => 
    			array('Description.status_id' => 3, 'AND' => array('Description.department_id' => $deptID) ), 'order' => array('Description.id' => 'DESC'), 'limit' => 5 ));

			$users = $this->Description->User->find('all', array( 'limit' => 5, 'order' => array('User.id' => 'DESC') ));

			$contacts = $this->Description->Contact->find('all', array( 'limit' => 5, 'order' => array('Contact.id' => 'DESC') ));

			$this->set('pending', $pending );
			$this->set('approved', $approved );
			$this->set('denied', $denied );

			$this->set('users', $users );

			$this->set('contacts', $contacts );

    	}
    	else {

			$pending = $this->Description->find('all', array( 'conditions' => array('Description.status_id' => 1), 'order' => array('Description.id' => 'DESC'), 'limit' => 5 ));    	
			$approved = $this->Description->find('all', array( 'conditions' => array('Description.status_id' => 2), 'order' => array('Description.id' => 'DESC'), 'limit' => 5 ));
			$denied = $this->Description->find('all', array( 'conditions' => array('Description.status_id' => 3), 'order' => array('Description.id' => 'DESC'), 'limit' => 5 ));

			$users = $this->Description->User->find('all', array( 'limit' => 5, 'order' => array('User.id' => 'DESC') ));

			$contacts = $this->Description->Contact->find('all', array( 'limit' => 5, 'order' => array('Contact.id' => 'DESC') ));

			$this->set('pending', $pending );
			$this->set('approved', $approved );
			$this->set('denied', $denied );

			$this->set('users', $users );

			$this->set('contacts', $contacts );

    	}

    	//set the views count variables for use regardless of user or admin

		$countPending = $this->Description->find('count', array( 'conditions' => array('Description.status_id' => 1) ));
		$this->set('countPending', $countPending );
		$countApproved = $this->Description->find('count', array( 'conditions' => array('Description.status_id' => 2) ));
		$this->set('countApproved', $countApproved );
		$countDenied = $this->Description->find('count', array( 'conditions' => array('Description.status_id' => 3) ));
		$this->set('countDenied', $countDenied );
		$countPosted = $this->Description->find('count', array( 'conditions' => array('Description.is_posted' => 1) ));
		$this->set('countPosted', $countPosted );
		$countEmployers = $this->Description->User->find('count');
		$this->set('countEmployers', $countEmployers );

    }

    public function refine() {

		if ($this->request->is('post')) {

			$user = $this->Description->User->findById( $this->Auth->user('id') );

			$searchOption = $this->request->data['searchOption'];

			switch ( $searchOption ) {

				case 1: //show the most recent description based on id
					$descriptions = $this->Description->find('all', array( 'order' => array('Description.id ' => 'desc' ) ) );

					$this->set('descriptions', $descriptions );
					break;

				case 2: //order by department A-Z
					$descriptions = $this->Description->find('all', array( 'order' => array('Description.department_id ' => 'asc' ) ) );

					$this->set('descriptions', $descriptions );
					break;

				case 3: //order by user A-Z
					$descriptions = $this->Description->find('all', array( 'order' => array('Description.user_id ' => 'asc' ) ) );

					$this->set('descriptions', $descriptions );
					break;

				case 4: //order by title A-Z
					$descriptions = $this->Description->find('all', array( 'order' => array('Description.title ' => 'asc' ) ) );

					$this->set('descriptions', $descriptions );
					break;

				default:

					$this->redirect(array('action' => 'index'));
			}

		}

    }

    public function searchDesc() {

    	if ($this->request->is('post')) {

	    	//get the user row in the Users table based on the cached id in session
	    	$user = $this->Description->User->findById( $this->Auth->user('id') );
	    	//get the access level from the logged in user
	    	$accessLevel = $user['User']['access_id'];
	    	//get the department_id from the logged in user
	    	$deptID = $user['User']['department_id'];

	    	//get the search term from the post data
	    	$searchTerm = $this->request->data['searchterm'];

	    	//if the user has employer access, filter the descriptions by the users department
	    	//and then show descriptions that are like the search term based on title or job number
	    	if( $accessLevel == 2 ) {

		    	$descriptions = $this->Description->find('all', array( 'conditions' => array( 'OR' => array(

		    		array('Description.title LIKE ' => "%$searchTerm%"), array('Description.number LIKE ' => "%$searchTerm%") ), 

		    		'Description.department_id' => $deptID ) ) );

		    	$this->set('descriptions', $descriptions );

	    	}
	    	//if they're an admin, show all of the descriptions that are like the search term based on either title or number
	    	else {

		    	$descriptions = $this->Description->find('all', array( 'conditions' => array( 'OR' => array(

		    		array('Description.title LIKE ' => "%$searchTerm%"), array('Description.number LIKE ' => "%$searchTerm%") ) ) ) );


	    		$this->set('descriptions', $descriptions );

	    	}

    	}
    	else {

    		$this->redirect(array('action' => 'index'));

    	}

    }

    public function searchPost() {

    	if ($this->request->is('post')) {

	    	//get the user row in the Users table based on the cached id in session
	    	$user = $this->Description->User->findById( $this->Auth->user('id') );
	    	//get the access level from the logged in user
	    	$accessLevel = $user['User']['access_id'];
	    	//get the department_id from the logged in user
	    	$deptID = $user['User']['department_id'];

	    	//get the search term from the post data
	    	$searchTerm = $this->request->data['searchterm'];

	    	//if the user has employer access, filter the approved descriptions by the users department
	    	//and then show descriptions that are like the search term based on title or job number
	    	if( $accessLevel == 2 ) {

		    	$descriptions = $this->Description->find('all', array( 'conditions' => array( 'OR' => array(

		    		array('Description.title LIKE ' => "%$searchTerm%"), array('Description.number LIKE ' => "%$searchTerm%") ), 

		    		'Description.department_id' => $deptID, 'AND' => array('Description.status_id' => 2) ) ) );

		    	$this->set('descriptions', $descriptions );

	    	}
	    	//if they're an admin, show all of the approved descriptions that are like the search term based on either title or number
	    	else {

		    	$descriptions = $this->Description->find('all', array( 'conditions' => array( 'OR' => array(

		    		array('Description.title LIKE ' => "%$searchTerm%"), array('Description.number LIKE ' => "%$searchTerm%") ), 

		    		array( 'status_id' => 2 ) ) ) );


	    		$this->set('descriptions', $descriptions );

	    	}

    	}
    	else {

    		$this->redirect(array('action' => 'postings'));

    	}

    }


    public function index() {

    	//get the user row in the Users table based on the cached id in session
    	$user = $this->Description->User->findById( $this->Auth->user('id') );
    	//get the access level from the logged in user
    	$accessLevel = $user['User']['access_id'];
    	//get the department_id from the logged in user
    	$deptID = $user['User']['department_id'];

    	//if the user has employer access, filter the descriptions by the users department
    	if( $accessLevel == 2 ) {

	    	$descriptions = $this->Description->find('all', array( 'conditions' => array('Description.department_id' => $deptID) ) );

	    	$this->set('descriptions', $descriptions );

    	}
    	//if they're an admin, show all of the descriptions, no filter
    	else {

    		$this->set('descriptions', $this->Description->find('all') );

    	}

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

					//reset the admin notes to an empty string as the job has been resubmitted for approval
					$this->request->data['Description']['admin_notes'] = '';

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

	            $this->Session->setFlash(__('Job Description has been updated.'), 'info_message');
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to Update Job Description.'), 'danger_message');
	    }

	    if (!$this->request->data) {
	        $this->request->data = $description;
	    }

	}

	//assign a job number to a given description before approving
	function assign( $id = null) {

	    if ( !$id ) {
	        throw new NotFoundException(__('Invalid Description'));
	    }

	    //get the description row based on the id passed in the method
	    //if it exists, run the update, otherwise throw an exception
	    if ( !($desc = $this->Description->read(null, $id)) ) {
	    	throw new NotFoundException(__('Invalid Description'));
	    }

	    $firstThreeOfDeptNumber = substr( $desc['Description']['number'] , 0, 3);

	    //descriptions with the same first three digits of dept number
	    $sameDeptDescs = $this->Description->find('all', array( 'conditions' => array( 'Description.status_id' => 2, 'Description.number LIKE' => "$firstThreeOfDeptNumber%" ), 'order' => array('Description.number' => 'DESC') ) );

	    $this->set('sameDeptDescs', $sameDeptDescs );

	    $this->set( 'assignDesc', $desc);


	}

	public function approve() {

        if ($this->request->is('post')) {

        	//get the admin entered, complete job number
        	$jobNumber = $this->request->data['jobnumber'];

        	$jobId = $this->request->data['jobid'];

		    //get the description row based on the id passed in the method
		    //if it exists, run the update, otherwise throw an exception
		    if ( !($desc = $this->Description->read( null, $jobId )) ) {
		    	throw new NotFoundException(__('Invalid Description'));
		    }

	    	//set the descriptions necessary hard coded changes because it is now a job
	    	//initially set job to not posted
	    	//clear the admin notes as the description has been approved
			$this->Description->set( array('status_id' => 2, 'is_posted' => 0, 'admin_notes' => '', 'number' => $jobNumber )  );
			//save the model, update the row in the db
			$this->Description->save();

			$this->Session->setFlash(__( $desc['User']['username'] . "'s " . 'job description has been approved!'), 'success_message');

			//redirect to the index controller method
		    return $this->redirect(array('action' => 'index'));
        }

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

		$this->Session->setFlash(__( $desc['User']['username'] . "'s " . 'job description has been denied!'), 'danger_message');

		//redirect to the index controller method
	    return $this->redirect(array('action' => 'index'));

	}

	//get all of the descriptions where the status is approved, which means the
	//description has been approved and is now considered a job and is initially posted (job posting)
    public function postings() {

    	//get the user row in the Users table based on the cached id in session
    	$user = $this->Description->User->findById( $this->Auth->user('id') );
    	//get the access level from the logged in user
    	$accessLevel = $user['User']['access_id'];
    	//get the department_id from the logged in user
    	$deptID = $user['User']['department_id'];

    	//if the user has employer access, filter the approved descriptions by the users department
    	if( $accessLevel == 2 ) {

	    	$descriptions = $this->Description->find('all', array( 
	    		'conditions' => array('Description.department_id' => $deptID, 'AND' => array('Description.status_id' => 2)) ) );

	    	$this->set('descriptions', $descriptions );

    	}
    	//if they're an admin, show all of the approved descriptions, no filter
    	else {

    		$this->set('descriptions', $this->Description->find('all', array('conditions' => array('status_id' => 2))) );

    	}

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

		$this->Session->setFlash(__( $desc['User']['username'] . "'s " . 'job has been posted!'), 'success_message');

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

		$this->Session->setFlash(__( $desc['User']['username'] . "'s " . 'job is not longer posted!'), 'danger_message');

		//redirect to the index controller method
	    return $this->redirect(array('action' => 'postings'));

    }


}