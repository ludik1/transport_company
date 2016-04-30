<?php

namespace Hyp\Forms\Controls;

/**
 * Form datetime field item
 *
 * @author Jakub Jarabica
 */
class DateTime extends BaseDateTime
{
	/** @var string */
	public static $dateFormat = 'd.m.Y H:i';
	public static $jsFormat = 'dd.mm.yyyy hh:ii';


	/**
	 * @param string control name
	 * @param string label
	 * @param int width of the control
	 * @param int maximum number of characters the user may enter
	 */
	public function __construct($label = NULL, $cols = NULL, $maxLength = NULL)
	{
		parent::__construct($label, $cols, $maxLength);
		$this->format = static::$dateFormat;
		$this->control->class[] = 'datetimepicker';
		$this->control->data('date-format', static::$jsFormat);
	}
}
