<?php

namespace FRI\LDAP;

class adLDAP extends \adLDAP
{
	public function __construct($options = [])
	{
		if (count($options) > 0) {
            if (array_key_exists("account_suffix", $options)) {
                $options["account_suffix"] = '@'.$options["account_suffix"];
            }
		}
		parent::__construct($options);
	}

}