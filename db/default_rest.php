<?php
class NodesController extends AppController {
	public function index()
	{
		// ----- json setting ------
		$this->viewClass = 'Json';
		$this->RequestHandler->setContent('json', 'application/json' );	

		$data = $this->Node->find('jsonList');

		// -------- json setting ---------
		$this->set('data', $data);
		$this->set('__serialize', 'data');
	}

	public function view($id = null)
	{
		// ----- json setting ------
		$this->viewClass = 'Json';
		$this->RequestHandler->setContent('json', 'application/json' );	
		
		$id = 1;

		if($id == null ){ throw new BadRequestException(); }
		$data = $this->Node->find('jsonItem', array('conditions' => array('id' => $id)));

		// -------- json setting ---------
		$this->set('data', $data);
		$this->set('__serialize', 'data');
	}


	public function add()
	{
		// ----- json setting ------
		$this->viewClass = 'Json';
		$this->RequestHandler->setContent('json', 'application/json' );
		$data = array();

		if ($result = $this->Node->save($this->request->data)) {
			$data = $result['Node'];
		} else {
			$this->Session->setFlash(__('The node could not be saved. Please, try again.'));
		}
			
		// -------- json setting ---------
		$this->set('data', $data);
		$this->set('__serialize', 'data');	
	}

	public function edit($id=null)
	{
		// ----- json setting ------
		$this->viewClass = 'Json';
		$this->RequestHandler->setContent('json', 'application/json' );
		$data = array();

		$this->Node->id = $id;

		if (!$this->Node->exists()) {
			throw new NotFoundException(__('Invalid node'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($result = $this->Node->save($this->request->data)) {
					$data = $result['Node'];
			} else {
				$this->Session->setFlash(__('The node could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Node->read(null, $id);
		}

		// -------- json setting ---------
		$this->set('data', $data);
		$this->set('__serialize', 'data');	
	}

	public function delete($id = null) {
		if (!$this->request->is('post') && !$this->request->is('delete')) {
			throw new MethodNotAllowedException();
		}
		
		$this->Node->id = $id;
		
		if (!$this->Node->exists()) {
			throw new NotFoundException(__('Invalid node'));
		}
		
		if ($this->Node->delete()) {
			$this->Session->setFlash(__('Node deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
}