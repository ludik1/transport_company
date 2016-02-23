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
		$form = new UserForm();
		$form->onSuccess[] = $this->userFormSubmitted;
		return $form;
	}
	
	public function userFormSubmitted(UserForm $form)
	{
		echo 't';
	}

	/**
	* @return UserGrid
	*/
       protected function createComponentUsersGrid()
       {
	   $grid = new UsersGrid($this->usersModel);

	   return $grid;
       }
}

