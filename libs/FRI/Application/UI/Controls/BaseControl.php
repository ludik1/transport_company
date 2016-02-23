<?php

namespace FRI\Application\UI\Controls;

use Nette\Application\UI\Control,
	Nette\Utils\Callback;

abstract class BaseControl extends Control
{

	use \FRI\Application\UI\Control\ConfigureTrait;

	public function render()
	{
		$reflection = $this->getReflection();
		$className = $reflection->getName();

		$name = substr($className, strrpos($className, '\\') + 1, -strlen('Control'));
		$templatePath = dirname($reflection->getFileName())
			. '/../templates/components/' . ucfirst($name) . '/default.latte';

		if (file_exists($templatePath))
		{
			$this->template->setFile($templatePath);
		}

		$this->template->locale = $this->getPresenter()->locale;
		$this->template->auth = $this->auth;

		if (method_exists($this, 'beforeRender'))
		{
			Callback::invokeArgs([$this, 'beforeRender'], func_get_args());
		}

		$this->template->render();
	}
}
