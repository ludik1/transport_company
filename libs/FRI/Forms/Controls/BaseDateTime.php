<?php

namespace FRI\Forms\Controls;

use \Nette\DateTime;

/**
 *
 * @author Jakub Jarabica
 *
 * @property \Nette\DateTime $value
 */
abstract class BaseDateTime extends \Nette\Forms\Controls\TextInput
{
	protected $format;


	/**
	 * @return \Nette\DateTime|NULL
	 */
	public function getValue()
	{
		$value = parent::getValue();
		if ($value == '')
			return NULL;

		return DateTime::from($value);
	}

	/**
	 * @param \DateTime
	 * @return BaseDateTime
	 */
	public function setValue($value)
	{
		try
		{
			if ($value instanceof DateTime || $value instanceof \DibiDateTime)
			{
				parent::setValue($value->format($this->format));
			}
			elseif ($value != '')
			{
				$date = DateTime::from($value);
				parent::setValue($date->format($this->format));
			}
		}
		catch (\Exception $e)
		{
			return parent::setValue(NULL);
		}
	}

	/**
	 * @param BaseDateTime
	 * @return bool
	 */
	public static function validateValid(\Nette\Forms\IControl $control)
	{
		$value = $control->getValue();
		return (is_null($value) || $value instanceof DateTime);
	}

	/**
	 * @return bool
	 */
	public function isFilled()
	{
		return (bool) $this->getValue();
	}
}
