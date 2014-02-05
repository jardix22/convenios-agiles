<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $helpers = array('PhpExcelApp');

	public function beforeFilter()
	{
		$this->logged();
	}

	public $components = array(
		'RequestHandler',
		'Session'
	);

	public function logged()
	{
		if (!$this->Session->read('loggedIn')) { 
			return $this->redirect(array('controller' => 'main', 'action' => 'login'));
		}
	}

	public function isLogged()
	{
		$state = $this->Session->read('loggedIn') ? true : false; 

		return $state ? $this->redirect(array('controller' => 'main', 'action' => 'index')) : 0;
	}

	public function isAuthenticated(){
		
		if ($this->Session->read('loggedIn')) {
			return true;
		}else{
			throw new ForbiddenException('Could not find that post');
		}
	}
}
