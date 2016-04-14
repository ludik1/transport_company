<?php

namespace App\AdminModule\Presenters;

use Models\UsersModel,
    FrontModule\Forms\UserForm,
	FrontModule\Forms\UserEditForm,
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
	
	public function actionAdd()
	{
		$form = $this['userForm'];
		$form->addSubmit('ok', 'Pridať');
		$form->onValidate[] =$this->registrationFormValidate;
		$form->onSuccess[] = $this->userFormSubmitted;

		$this->template->title = 'Pridanie užívateľa';
	}
	
	/**
	 * 
	 * @return UserForm
	 */
	protected function createComponentUserForm()
	{
		$form = new UserForm($this->usersModel->getUserRoles());
		
		return $form;
	}
	
	protected function createComponentUserEditForm()
	{
		$form = new UserEditForm($this->usersModel->getUserRoles());
		
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
	
	/**
     * @param int $user_id
     */
    public function actionEdit($user_id)
    {
        $user = $this->usersModel->getUser($user_id);
		if (!$user)
		{
			$this->error();
		}
		$this->template->user_id = $user_id;
		$form = $this['userEditForm'];
		$form['login']->setDisabled();			
		$form->setDefaults($user);
		$form->addSubmit('ok', 'Upraviť');		
		$form->onValidate[] =$this->editFormValidate;
		$form->onSuccess[] = $this->userFormEdit;
    }
	
	public function userFormEdit(UserEditForm $form)
    {
        $values = $form->getValues();
		unset($values->user_id);
//		if (!isset($values->oldPassword))
//		{
//			unset($values->password);
//		}
//		else
//		{
//			$values->password = sha1($values->password);
//		}
//		unset($values->password2);
//		unset($values->oldPassword);
		$user['employed_from'] = $values->employed_from;
		$user['employed_to'] = $values->employed_to;
		unset($values->employed_from);
		unset($values->employed_to);
        $this->usersModel->updateUser($this->template->user_id, $values);
		$this->usersModel->update($this->template->user_id, $user);
        $this->flashMessage('Užívateľ bol úspešne editovaný!');
        $this->redirect('User:');
    }
	
	/**
     * @param int $user_id
     */
    public function handleDelete($user_id)
    {
        $this->usersModel->delete($user_id);
		
		$this->flashMessage('Užívateľ bol úspešne vymazaný!');
        $this->redirect('User:');
    }
	
	public function editFormValidate(UserEditForm $form)
	{
		$values = $form->getValues();
		$user = $this->usersModel->find($this->template->user_id);
		
		if(isset($values->oldPassword) && $user->password == sha1($values->oldPassword))
		{
			$form->addError('Staré heslo sa nezhoduje');
		}		
	}
}

