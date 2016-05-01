<?php

namespace FrontModule\Forms;

use Hyp\Application\UI\Form;

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

		$this->addText('car_id', 'Evidenčné číslo auta')
			->addRule(self::LENGTH,'Dĺžka EČV musí byť 7 znakov', 7)
			->setRequired('Prosím vyplňte toto pole');

		$this->addText('size', 'Veľkosť')
			->setDefaultValue(100)
			->setRequired();
		
		$this->addText('weight', 'Váha')
			->setDefaultValue(25000)
			->setRequired();
		$this->addDate('reserved_from', 'Rezervované od');
		$this->addDate('reserved_to', 'Rezervované do')
			->addRule(function($dateTo)
			{
				$dateFrom = $this['reserved_from'];
				if($dateFrom->value <= $dateTo->value){
				return true;
				}
				?><script>alert('Dátum do musí byť neskorší ako dátum od.')</script><?php
				return false;
			}, 'Dátum do musí byť neskorší ako dátum od.')
			->addConditionOn($this['reserved_from'], Form::FILLED, true)
			->setRequired();
	}
}
