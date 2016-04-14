<?php

namespace FrontModule\Forms;

use FRI\Application\UI\Form;

final class DistributionPlanForm extends Form
{
	/**
	 * @param Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);

		$this->addSubmit('ok', 'Potvrdiť');
	}
}
