<?php

namespace FrontModule\Forms;

use FRI\Application\UI\Form;

final class UserEditForm extends Form
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

		$this->addText('login', 'Login');
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
