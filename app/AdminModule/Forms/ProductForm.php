<?php

namespace FrontModule\Forms;

use FRI\Application\UI\Form;

final class ProductForm extends Form
{
	const PRIORITY = array(
	    1 => '1',
	    2 => '2',
	    3 => '3',
	    4 => '4',
	    5 => '5',
	);

	private $cities;
	
	public function __construct($cities)
	{		
		parent::__construct();
		
		$this->cities = $cities;
	}

	/**
	 * @param Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);
		
		$this->addText('name', 'Názov produktu')
			->setRequired();
		$this->addText('amount', 'Počet')
			->setRequired();		
		$this->addText('size', 'Veľkosť (m³)')
			->addRule(self::INTEGER, 'Veľkosť musí byť číslo')
			->addRule(self::RANGE, 'Veľkosť musí byť od 1 do 100', array(1, 100))
			->setRequired();
		$this->addText('weight', 'Váha (kg)')
			->addRule(self::INTEGER, 'Váha musí byť číslo')
			->addRule(self::RANGE, 'Váha musí byť od 1 do 1000', array(1, 1000))
			->setRequired();
		$this->addDate('date', 'Dátum doručenia')
			->setRequired();	
		$this->addSelect('from', 'Doručenie z mesta')
			->setItems($this->cities)
			->setRequired();	
		$this->addSelect('to', 'Doručenie do mesta')
			->setItems($this->cities)
			->setRequired();
		$this->addSelect('priority', 'Priorita', self::PRIORITY)
			->setPrompt('Vyberte prosím')
			->setRequired();
		$this->addTextArea('info', 'Informácie o produkte');		
	}
}
