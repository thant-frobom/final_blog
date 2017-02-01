<?php
	App::uses('AppController','Controller');
	//User Controller
	class UsersController extends AppController
	{
		public function beforeFilter()
		{
			parent::beforeFilter();
			$this->Auth->allow('add','logout', 'login');
/*			$this->Auth->fields=array(		//Login with email
					'username'=>'email',
					'password'=>'password'
				);*/

				
	
			//$this->Auth->allow('index','view');
	
		}

		/*public function index()
		{
			$this->User->recursive=0;
			$this->set('users',$this->paginate());
		}*/

		/*public function view($id=null)
		{
			$this->User->id=$id;
			if(!$this->User->exists())
			{
				throw new NotFoundException(__('Invalid user'));
			}
			$this->set('user', $this->User->findById($id));
		}*/


		public function add()
		{
			if($this->request->is('post'))
			{
				$this->User->create();
				$psw1=$this->request->data['User']['password'];
				$psw2=$this->request->data['User']['confirm_password'];
				if($psw1!=$psw2)
				{
					$this->Flash->error(__('Passwords must be the same.'));
					return false;
				}
				if($this->User->save($this->request->data))
				{
					return $this->redirect(array('action'=>'login'));
				}
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		
		}

		public function login()
		{
			if($this->request->is('post'))
			{
				if($this->Auth->login())
				{
					//return $this->redirect($this->Auth->redirectUrl());
					//$this->Flash->success(__('Success'));
					return $this->redirect(array('action'=>'../posts/index'));
				}
				$this->Flash->error(__('Invalid username or password, try again.'));
			}
		} 
		public function logout()
		{
			return $this->redirect($this->Auth->logout());
			//$this->redirect(array('actioon'=>'../users/add'));
		}
	}
?>	
