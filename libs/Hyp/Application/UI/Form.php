<?php

namespace Hyp\Application\UI;

use Hyp\Forms\Controls,
	Nette\Application\UI\Presenter;

/**
 * Sets up default behavior for every form
 *
 * @author Jakub Jarabica
 */
class Form extends \Nette\Application\UI\Form
{

	use \Hyp\Application\UI\Control\ConfigureTrait;

	public function __construct($parent = NULL, $name = NULL)
	{
		parent::__construct($parent, $name);

		$renderer = $this->getRenderer();
		$this->getElementPrototype()->class[] = "form-horizontal";
		$renderer->wrappers['controls']['container'] = NULL;
		$renderer->wrappers['pair']['container'] = "div class=control-group";
		$renderer->wrappers['control']['container'] = "div class=controls";
		$renderer->wrappers['control']['.submit'] = "btn btn-primary";
		$renderer->wrappers['label']['requiredsuffix'] = "<span style='color: red'>*</span>";
		$renderer->wrappers['label']['container'] = NULL;
		$this->setRenderer($renderer);
	}

	/**
	 * @param Presenter $presenter
	 */
	protected function configure(Presenter $presenter)
	{
//		$this->setTranslator($presenter->translator);
	}

	/**
	 * Adds ImageUpload control to form
	 * @param string $name
	 * @param string $label
	 * @return \Nette\Forms\IControl fluent interface
	 */
	public function addImageUpload($name, $label)
	{
		return $this[$name] = new Controls\ImageUpload($label);
	}

	/**
	 * Adds DatePicker control
	 * @param string $name
	 * @param string $label
	 * @param string $cols
	 * @param string $maxLength
	 * @return \Hyp\Forms\Controls\Date
	 */
	public function addDate($name, $label, $cols = NULL, $maxLength = NULL)
	{
		return $this[$name] = new Controls\Date($label, $cols, $maxLength);
	}

	/**
	 * Adds DateTimePicker control
	 * @param string $name
	 * @param string $label
	 * @param string $cols
	 * @param string $maxLength
	 * @return \Hyp\Forms\Controls\Date
	 */
	public function addDateTime($name, $label, $cols = NULL, $maxLength = NULL)
	{
		return $this[$name] = new Controls\DateTime($label, $cols, $maxLength);
	}

	/**
	 * Adds toggable control group
	 * @param string $caption
	 * @param bool   $open
	 * @param string $class
	 * @return \Nette\Forms\ControlGroup
	 */
	public function addToggleGroup($caption, $open = TRUE, $class = "")
	{
		$cg = $this->addGroup($caption, TRUE);
		$cg->setOption(
			'container', \Nette\Utils\Html::el(
				'div', [
					'class' => $class.' form-toggle' . ($open ? ' open' : '')
				]
			)
		);

		return $cg;
	}
}
