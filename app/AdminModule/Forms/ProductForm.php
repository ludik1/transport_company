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
		
		$this->addText('name', 'Názov produktu')
			->setRequired();
		$this->addText('count', 'Počet')
			->setRequired();
		$this->addText('weight', 'Váha')
			->setRequired();
		$this->addText('size', 'Veľkosť')
			->setRequired();
		$this->addDate('date', 'Dátum doručenia')
			->setRequired();
		$this->addText('from', 'Doručenie z mesta')
			->setRequired();		
		$this->addText('to', 'Doručenie do mesta')
			->setRequired();
		$this->addSelect('priority', 'Priorita', self::PRIORITY)
			->setPrompt('Vyberte prosím')
			->setRequired();
		$this->addTextArea('info', 'Informácie o produkte');

		$this->addSubmit('submit', 'Pridať');
	}
}
