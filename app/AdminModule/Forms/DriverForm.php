<?php

namespace FrontModule\Forms;

use FRI\Application\UI\Form;

final class DriverForm extends Form
{
	private $drivers;
	private $cars;
	
	public function __construct($drivers, $cars)
	{		
		parent::__construct();
		
		$this->drivers = $drivers;
		$this->cars = $cars;
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
		$this->addSelect('car_id', 'Evidenčné číslo auta', $this->cars())
			->setPrompt('Vyberte prosím')
			->setRequired();


		$this->addSubmit('submit', 'Pridať');
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
	public function cars()
	{
		$cars = array();

		foreach ($this->cars as $car)
		{
			$cars[$car->car_id] = $car->car_id;
		}
		return $cars;
	}
}
