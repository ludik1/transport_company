<?php

namespace FrontModule\Forms;

use FRI\Application\UI\Form;

final class CarForm extends Form
{
	private $drivers;
	
	public function __construct($drivers)
	{		
		parent::__construct();
		
		$this->drivers = $drivers;
	}

	/**
	 * @param Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);

		$this->addSelect('user_id', 'Šofér', $this->drivers())
			->setPrompt('Vyberte prosím')
			->setRequired();
		$this->addText('car_id', 'Evidenčné číslo auta')
			->setRequired('Prosím vyplňte toto pole');

		$this->addText('size', 'Veľkosť')
			->setRequired();
		
		$this->addText('weight', 'Váha')
			->setRequired();
		
		$this->addDate('reserved_from', 'Rezervované od');
		
		$this->addDate('reserved_to', 'Rezervované do');
	}
	
	public function drivers()
	{
		$drivers = array();
		
		foreach ($this->drivers as $driver)
		{
			$drivers[$driver->user_id] = $driver->name.' '.$driver->surname;
		}
		return $drivers;
	}
}
