<?php

namespace FrontModule\Forms;

use Hyp\Application\UI\Form;

final class OptimalizationForm extends Form
{
	const TYPE = array(
		'price' => 'Cena',
		'priority' => 'Priorita',
		'size' => 'Veľkosť',
		'weight' => 'Váha',		
	);
	
	const SORT = array(
		'ASC' => 'Vzostupne',
		'DESC' => 'Zostupne'
	);
	
	const SPLIT = array(
		'true' => 'Rozdeliť',
		'false' => 'Nerozdeliť'
	);
	
	/**
	 * @param Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);
		
		$this->addSelect('type','Optimalizovať podľa', self::TYPE)
				->setPrompt('Vyberte prosím')
				->setRequired();
		$this->addSelect('sort','Zoradiť', self::SORT)
				->setPrompt('Vyberte prosím')
				->setRequired();
		$this->addSelect('split','Rozdelenie produktu do kamiónov', self::SPLIT)
				->setPrompt('Vyberte prosím')
				->setRequired();
		$this->addSubmit('ok', 'Potvrdiť');
	}
}
