<?php

App::uses('AppController', 'Controller');

class MainController extends AppController {
	public $uses = array();

	public function beforeFilter()
	{
		if ($this->action == 'login') {
			return;
		}
		parent::beforeFilter();
	}

	public function login() {
		$this->isLogged();
		$this->layout = "login_layout";
	}

	public function index()
	{
		$this->layout = "index_layout";
	}
}
