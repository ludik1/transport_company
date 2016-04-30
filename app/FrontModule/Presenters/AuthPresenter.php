<?php
namespace App\FrontModule\Presenters;

use FrontModule\Forms\LoginForm,
	FrontModule\Forms\RegistrationForm,
	Nette\Security\AuthenticationException;

class AuthPresenter extends BasePresenter
{
	/** @var \Models\UsersModel */
	private $usersModel;
	/** @var \Models\UserRolesModel */
	private $userRolesModel;


	public function __construct(\Models\UsersModel $um, \Models\UserRolesModel $urm)
	{
		$this->usersModel = $um;
		$this->userRolesModel = $urm;
	}
	/*
	 * @var string|NULL $backlink
	 */
	public function actionLogin($backlink = NULL)
	{
		if($this->getUser()->isLoggedIn())
		{
			$this->redirect(':Admin:Homepage:');
		}
	}
	
	public function actionOut()
	{
		$this->user->logout();

		$this->flashMessage('Boli ste úspešne odhlásení.', 'info');
		$this->redirect(':Front:Homepage:');
	}
		
	/**
	 * @return LoginForm
	 */
	protected function createComponentLoginForm()
	{
		$form = new LoginForm();
		$form->onSuccess[] = $this->loginFormSubmitted;
		
		return $form;
	}
	
	/**
	 * @param LoginForm
	 */
	public function loginFormSubmitted(LoginForm $form)
	{
		$values = $form->getValues();
		try
		{
			$this->user->setExpiration(0, TRUE);			
			$this->user->login($values->login, sha1($values->password));
			if ($this->getUser()->isInRole(1))
			{
				$this->redirect(':Admin:Homepage:');
			} elseif ($this->getUser()->isInRole(2)) {
				$this->redirect(':Admin:Optimalization:driver');
			} elseif ($this->getUser()->isInRole(3)) {
				$this->redirect(':Admin:Product:default');
			}
			$this->redirect(':Admin:Homepage:');
		}
		catch(AuthenticationException $e)
		{
			$form->addError('Nesprávne meno alebo heslo!');
		}
	}

	
	/**
	 * @param RegistrationForm
	 */
	public function registrationFormSubmitted(RegistrationForm $form)
	{
		$values = $form->getValues();
		
		$values->password = sha1($values->password);
		$values->role_id = 3;
		$this->usersModel->insertUser($values);

		$this->flashMessage('Registrácia bola úspešná!', 'success');
		$this->redirect(':Front:Auth:login');
	}
	
	/**
	 * @return RegistrationForm
	 */
	protected function createComponentRegistrationForm()
	{
		$form = new RegistrationForm();
		$form->onValidate[] =$this->registrationFormValidate;
		$form->onSuccess[] = $this->registrationFormSubmitted;
		
		return $form;
	}
	
	/**
	 * @param RegistrationForm
	 */
	public function registrationFormValidate(RegistrationForm $form)
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