<?php

namespace FRI\Application\UI\Controls;

use Grido\Grid;
use Nette\Application\UI\Presenter;

abstract class BaseGrid extends Grid
{

	use \FRI\Application\UI\Control\ConfigureTrait { configure as configureTrait_configure; }
	
	/**
	 * @param Presenter $presenter
	 */
	protected function configure(Presenter $presenter)
	{
		$this->configureTrait_configure($presenter);
		$this->setStrictMode(FALSE);
	}
	
}
