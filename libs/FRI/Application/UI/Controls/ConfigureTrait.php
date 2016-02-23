<?php

namespace FRI\Application\UI\Control;

use Nette\Application\UI\Presenter;

trait ConfigureTrait
{
	/**
	 * @var \Unlink\Auth\IAuthorizator
	 */
	protected $auth;


	/**
	 * @param \Nette\ComponentModel\IComponent $component
	 */
	protected function attached($component)
	{
		parent::attached($component);

		if (!($component instanceof Presenter))
		{
			return;
		}

//		$this->auth = $component->getAuth(); Juraj koment
		$this->configure($component);
	}

	/**
	 * @param Presenter $presenter
	 */
	protected function configure(Presenter $presenter)
	{

	}
}
