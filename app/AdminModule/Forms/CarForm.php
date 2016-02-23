<?php

namespace FrontModule\Forms;

use FRI\Application\UI\Form;

final class CarForm extends Form
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

		$this->addText('id', 'Evidenčné číslo auta')
			->setRequired('Prosím vyplňte toto pole');

		$this->addText('size', 'Veľkosť')
			->setRequired();
		
		$this->addText('weight', 'Váha')
			->setRequired();
		
		$this->addText('surname', 'Priezvisko')
			->setRequired();

		$this->addSubmit('submit', 'Pridať');
	}
}
