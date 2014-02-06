<?php
class AgreementsController extends AppController
{	
	public function beforeFilter($value='') {
		if (parent::isAuthenticated()){
			$this->loadModel('Lifeline');
		}
	}

	public function index()	{
		$this->viewClass = 'Json';
		$this->RequestHandler->setContent('json', 'application/json' );			
		
		$data = $this->Agreement->find('jsonList');		
		
		$this->set('data', $data);
		$this->set('__serialize', 'data');
	}

	public function view($id = null) {
		$this->viewClass = 'Json';
		$this->RequestHandler->setContent('json', 'application/json');	
		
		if($id){ 
			throw new NotFoundException('Could not find that agreeement');
		}
		$data = $this->Agreement->find('jsonItem', array('conditions' => array('id' => $id)));

		$this->set('data', $data);
		$this->set('__serialize', 'data');
	}

	public function add(){
		// ----- json setting ------
		$this->viewClass = 'Json';
		$this->RequestHandler->setContent('json', 'application/json' );
		$data = array();

		if ($result = $this->Agreement->save($this->request->data)) {
			//Lifeline 	
			$this->Lifeline->Push($result['Agreement']['id'], 'created', $this->Session->read('userId'));
			$data = $result['Agreement'];
		} else {
			$this->Session->setFlash(__('The car could not be saved. Please, try again.'));
		}

		// -------- json setting ---------
		$this->set('data', $data);
		$this->set('__serialize', 'data');
	}

	public function edit($id = null) {
		// ----- json setting ------
		$this->viewClass = 'Json';
		$this->RequestHandler->setContent('json', 'application/json' );
		$data = array();

		$this->Agreement->id = $id;

		if (!$this->Agreement->exists()) {
			throw new NotFoundException(__('Invalid agreeemnt'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($result = $this->Agreement->save($this->request->data)) {
					$this->Lifeline->Push($result['Agreement']['id'], 'modified', $this->Session->read('userId'));
					$data = $result['Agreement'];
			} else {
				$this->Session->setFlash(__('The agreeemnt could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Agreement->read(null, $id);
		}

		// -------- json setting ---------
		$this->set('data', $data);
		$this->set('__serialize', 'data');	
	}

	public function delete($id = null) {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Agreement->id = $id;
		
		if (!$this->Agreement->exists()) {
			throw new NotFoundException(__('Invalid agreeemnt'));
		}
		
		if ($this->Agreement->delete()) {
			$this->Lifeline->Push($id, 'deleted', $this->Session->read('userId'));
			$this->set('data', true);
			$this->set('__serialize', 'data');	
		}
	}

	public function search() {
		// ----- json setting ------
		$this->viewClass = 'Json';
		$this->RequestHandler->setContent('json', 'application/json' );

		$items = $this->request->query;
		$data = array();
		$conditions = array();
		$limit= array();

		// Title attribute
		if (isset($items['title']) && $items['title'] != "") {
			$title = "";
			$words = explode("+", $items['title']);

			if(count($words) > 1){
				foreach ($words as $word) {	
					$title = $title.'%'.trim($word).'%';
				}
			}else{
				$title = '%'.$items['title'].'%';
			}
			array_push($conditions, array('title LIKE' => $title)); 
		}

		// Responsible attribute
		if (isset($items['responsible']) && $items['responsible'] != "") {
			$responsible = "";
			$words = explode("+", $items['responsible']);

			if(count($words) > 1){
				foreach ($words as $word) {	
					$responsible = $responsible.'%'.trim($word).'%';
				}
			}else{
				$responsible = '%'.$items['responsible'].'%';
			}
			
			array_push($conditions, array('responsible LIKE' => $responsible)); 
		}


		// Suscription date attribute
		if (isset($items['suscription_date']) && $items['suscription_date'] != "") {
			$date = split(',', $items['suscription_date']);

			if (count($date) < 2) {
				array_push($conditions, array('suscription_date >=' => $items['suscription_date'])); 				
			}else{
				array_push($conditions, array('suscription_date >=' => $date[0])); 				
				array_push($conditions, array('suscription_date <' => $date[1])); 				
			}
		};

		if (isset($items['coverage_type']) && $items['coverage_type'] != "") {
			array_push($conditions, array('coverage_type ' => $items['coverage_type'])); 				
		};

		if (isset($items['location_type']) && $items['location_type'] != "") {
			array_push($conditions, array('location_type ' => $items['location_type'])); 				
		};

	
		$results = $this->Agreement->find('jsonList', array('conditions' => $conditions, 'limit' => 20));

		// filter with expired date
		if (isset($items['is_validity']) && $items['is_validity'] != "") {
			foreach ($results as $key => $value) {
				$date1 = new DateTime($value['expired_date']);
				$date2 = new DateTime();
				$interval = $date2->diff($date1);
				$is_validity = ($interval->format('%R%a days') < 0) ? false : true;
				
				if ($is_validity == $items['is_validity']) {
					array_push($data, $value);
				}
			}
		}else{
			$data = $results;
		};

		// -------- json setting ---------
		$this->set('data', $data);
		$this->set('__serialize', 'data');
	}

	public function iSearch() {	
		$data = $this->Agreement->find('jsonList', array('conditions' => array(), 'limit' => 30, 'fields' => array('suscription_date', 'expired_date')));

		foreach ($data as $key => $value) {
			$date1 = new DateTime($value['expired_date']);
			$date2 = new DateTime();
		    
		    $interval = $date2->diff($date1);

		    echo "<pre>";
			echo $interval->format('%R%a days');
		    echo "</pre>";
		}

		// -------- json setting ---------
		$this->set('data', $data);
		$this->set('__serialize', 'data');
	}
}