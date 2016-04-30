<?php

namespace FrontModule\Forms;

use Hyp\Application\UI\Form;

final class DriverForm extends Form
{
	private $drivers;
	private $cars;
	
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

		
	}
}
