<?php

namespace FRI\Forms\Controls;

/**
 * Form date field item
 *
 * @author Jakub Jarabica
 */
class Date extends BaseDateTime
{
	/** @var string */
	public static $dateFormat = 'd.m.Y';
	/** @var string */
	public static $jsFormat = 'dd.mm.yyyy';


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
		$this->control->class[] = 'datepicker';
		$this->control->data('date-format', static::$jsFormat);
	}
}
