<?php

namespace FrontModule\Forms;

use FRI\Application\UI\Form;

final class RegistrationForm extends Form
{

	public function __construct()
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
			->setRequired();
		$this->addPassword('password', 'Heslo')
			->setRequired();		
		$this->addPassword('password2', 'Potvrdenie hesla')
			->setRequired('Prosím, vyplňte povinné pole %label.')
			->addRule(self::EQUAL, '%label sa nezhoduje so zadaným heslom.', $this['password']);		
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
		$this->addText('address', 'Adresa')
			->setRequired();
		
		$this->addSubmit('submit', 'Registrovať');
	}
}
