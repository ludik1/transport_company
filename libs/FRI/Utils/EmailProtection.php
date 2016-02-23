<?php

namespace FRI\Utils;

use Nette\Utils\Html;

class EmailProtection
{

	/**
	 * @param $content text content to filter
	 * @return string filtered content
	 */
	public static function protect($content)
	{
		$regExp = "/(?<mail>[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+)/im";
		return preg_replace_callback($regExp, function ($mail)
		{
			return str_rot13($mail["mail"]);
		}, $content);
	}
}
