<?php

namespace FRI\Mail;

class FakeMailer extends \Nette\Object implements \Nette\Mail\IMailer
{
	/**
	 * @var \Nette\Mail\IMailer
	 */
	private $origMailer;
	/**
	 * @var array
	 */
	private $mailers;


	public function __construct(\Nette\Mail\IMailer $origMailer, $mailers)
	{
		$this->origMailer = $origMailer;
		$this->mailers = $mailers;
	}

	public function send(\Nette\Mail\Message $mail)
	{
		$tmp = clone $mail;
		$adresees = 'Adresáti: <br>';
		foreach (['To', 'Cc', 'Bcc'] as $type)
		{
			foreach ((array) $tmp->getHeader($type) as $to => $name)
			{
				$adresees .= $type . ': ' . $to . (($name !== NULL) ? ' ' . $name : '') . '<br>';
			}
			$tmp->setHeader($type, NULL);
		}
		$adresees.='<hr><br>';

		$tmp->setHtmlBody($adresees . $tmp->getHtmlBody());
		foreach ($this->mailers as $email)
		{
			$tmp->addTo($email);
		}

		$this->origMailer->send($tmp);
	}
}
