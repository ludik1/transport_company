<?php

use Nette\Utils\DateTime;

class ProductFormRules
{
	const DATE = 'ProductFormRules::validateDate';

    public static function validateDate($form)
    {
		if($form->value > new DateTime()) 
		{
			return true;
		}	
		?><script>alert('Zadali ste nevalidný dátum')</script><?php
		return false;
    }
}
