<?php

class AccountController extends AppController {
	
	public function beforeFilter () {
		$this->loadModel('User');
		$this->layout = null;
    }

	public function logout($value=''){
		// ----- json setting ------
		$this->viewClass = 'Json';
		$this->RequestHandler->setContent('json', 'application/json' );

		$this->Session->write('loggedIn', false);
		$this->Session->write('userId', null);

		// -------- json setting ---------
		$this->set('data', true);
		$this->set('__serialize', 'data');	
	}	

	public function login($value=''){
		// ----- json setting ------
		$this->viewClass = 'Json';
		$this->RequestHandler->setContent('json', 'application/json' );


		if ($this->request->is('POST')) {
			$username = isset($this->request->data['username']) ? $this->request->data['username'] : null;
			$password = isset($this->request->data['password']) ? $this->request->data['password'] : null;

			if($username == null || strlen($username) < 1 || $password == null || strlen($password) < 1 ){
				throw new BadRequestException();
			}

			$user = $this->User->find('first', array(
				'conditions' => array(
					'username' => $username,
					'password' => md5($password)
					)
				)
			);

			if(!$user){
				throw new ForbiddenException('Acceso denegado');
			}

			$this->Session->write('loggedIn', true);
			$this->Session->write('userId', $user['User']['id']);
			$real_user = $this->setUser($user['User']);

			// -------- json setting ---------
			$this->set('data',array('ok' => true, 'userId'=> $real_user ));
			$this->set('__serialize', 'data');

		} else {
			throw new BadRequestException();
		}
	}
	
	private function setUser($user)
	{
		switch ($user['role_id']) {
			case 'admin':
				$this->Session->write('user', array('full_name' => "Admin", 'role' => 'Administrador'));
				$this->Session->write('userRole', $user['role_id']);
				break;
			default:
				$this->Session->write('userRole', 'anonimouse');
				break;
		}
		
		return $this->Session->read('user'); 
	}
}
