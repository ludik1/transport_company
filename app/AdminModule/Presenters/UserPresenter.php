<?php

namespace App\AdminModule\Presenters;

use Models\UsersModel,
    FrontModule\Forms\UserForm,
    AdminModule\Datagrids\UsersGrid;

class UserPresenter extends BasePresenter
{
	/**
	 * @var UsersModel
	 */
	private $usersModel;


	/**
	 * @param UsersModel $usersModel
	 */
	public function __construct(UsersModel $usersModel)
	{
		parent::__construct();

		$this->usersModel = $usersModel;
	}
	
	public function actionDefault()
	{		
		$this->template->users = $this->usersModel->getAllUsers();
	}
	
	/**
	 * 
	 * @return UserForm
	 */
	protected function createComponentUserForm()
	{
		$form = new UserForm($this->usersModel->getUserRoles());
		
		$form->onValidate[] =$this->registrationFormValidate;
		$form->onSuccess[] = $this->userFormSubmitted;
		
		return $form;
	}
	
	public function userFormSubmitted(UserForm $form)
	{
		$values = $form->getValues();
		
		$values->password = sha1($values->password);

		$this->usersModel->insertUser($values);
		
		$this->flashMessage('Užívateľ bol úspešne vložený!');
		$this->redirect(':Admin:User:default');
	}

	/**
	* @return UserGrid
	*/
	protected function createComponentUsersGrid()
    {
		$grid = new UsersGrid($this->usersModel);
		
		return $grid;		
	}
	
	/**
	 * @param RegistrationForm
	 */
	public function registrationFormValidate(UserForm $form)
	{
		$values = $form->getValues();

		foreach ($this->usersModel->getUsersLogin() as $user)
		{			
			if($user->login == $values->login)
			{
				$form->addError('Tento login je uz použitý');
			}
		}
		
	}
}

