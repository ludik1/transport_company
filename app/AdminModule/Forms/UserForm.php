<?php

namespace FrontModule\Forms;

use FRI\Application\UI\Form;

final class UserForm extends Form
{

	public function __construct($logins)
	{
		parent::__construct();
	}

	/**
	 * @param Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);

		$this->addText('login', 'Login')
			->setRequired('Prosím vyplňte toto pole');

		$this->addPassword('password', 'Heslo')
			->setRequired();
		
		$this->addText('name', 'Meno')
			->setRequired();
		
		$this->addText('surname', 'Priezvisko')
			->setRequired();
		
		$this->addText('ssn', 'Rodné číslo')
			->setRequired();
		$this->addText('email', 'Email')
			->setRequired();
		$this->addText('phone', 'Telefónne číslo')
			->setRequired();
		$this->addText('address', 'Adresa')
			->setRequired();

		$this->addSubmit('submit', 'Pridať');
	}
}
