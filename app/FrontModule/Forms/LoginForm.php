<?php

namespace FrontModule\Forms;

use Hyp\Application\UI\Form;

final class LoginForm extends Form
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

		$this->addSubmit('submit', 'Prihlásiť');
	}
}
