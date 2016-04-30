<?php

namespace FrontModule\Forms;

use Hyp\Application\UI\Form;

final class UserForm extends Form
{
	private $roles;
	
	public function __construct($roles)
	{		
		parent::__construct();
		
		$this->roles = $roles;
	}

	/**
	 * @param Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);

		$this->addText('login', 'Login')
			->setRequired();
		$this->addPassword('password', 'Heslo')
			->setRequired();		
		$this->addPassword('password2', 'Potvrdenie hesla')
			->setRequired('Prosím, vyplňte povinné pole %label.')
			->addRule(self::EQUAL, '%label sa nezhoduje so zadaným heslom.', $this['password']);
		$this->addSelect('role_id', 'Práva',  $this->roles())
			->setPrompt('Vyberte prosím')
			->setRequired();
		$this->addDate('employed_from', 'Zamestnaný od');
		$this->addDate('employed_to', 'Zamestnaný do');
		$this->addText('name', 'Meno')
			->setRequired();
		$this->addText('surname', 'Priezvisko')
			->setRequired();
		$this->addText('personal_id', 'Rodné číslo')
			->setRequired();
		$this->addText('email', 'Email')
			->setRequired();
		$this->addText('phone', 'Telefónne číslo')
			->setRequired();
		$this->addTextArea('address', 'Adresa')
			->setRequired();
	}
	
	public function roles()
	{
		$roles = array();
		
		foreach ($this->roles as $role)
		{
			$roles[$role->role_id] = $role->name;
		}
		return $roles;
	}
}
