<?php

namespace FRI\Security;

use Nette\Security\IAuthorizator;

final class User extends \Nette\Security\User
{
	const TEACHER = 14004;
	const STUDENT = 14005;


	/**
	 *
	 * @param \DibiConnection $connection
	 */
	public function sendUidToDb($connection)
	{
		if ($this->isLoggedIn())
		{
			if ($this->isLoggedAsOtherUser())
			{
				$connection->query('SET @friUser = %i', $this->getOtherUserId());
			}
			else
			{
				$connection->query('SET @friUser = %i', $this->storage->getIdentity()->getId());
			}
		}
		else
		{
			$connection->query('SET @friUser = NULL');
		}
	}

	/**
	 * @return bool
	 */
	public function isTeacher()
	{
		return isset($this->identity->data['gidnumber']) && $this->identity->data['gidnumber'] == self::TEACHER;
	}

	/**
	 * @return bool
	 */
	public function isStudent()
	{
		return isset($this->identity->data['gidnumber']) &&
			$this->identity->data['gidnumber'] == self::STUDENT;
	}

	/**
	 * @return bool
	 */
	public function isAdmin()
	{
		return $this->isInRole(1);
	}

	/**
	 * @param string $resource
	 * @param string $privilege
	 * @return bool
	 * @deprecated
	 */
	public function isAllowed($resource = IAuthorizator::ALL, $privilege = IAuthorizator::ALL)
	{
		trigger_error(__METHOD__ . '() is not implemented yet; use $auth->isAllowed() instead.', E_USER_ERROR);
	}

	/**
	 * @return bool
	 */
	public function isLoggedAsOtherUser()
	{
		return isset($this->getIdentity()->otherUserId);
	}

	/**
	 * @return int|FALSE
	 */
	public function getOtherUserId()
	{
		return $this->isLoggedAsOtherUser() ?
			$this->getIdentity()->otherUserId : FALSE;
	}

	/**
	 * @param int|NULL $otherUserId
	 */
	public function setOtherUserId($otherUserId = NULL)
	{
		$this->getIdentity()->otherUserId = $otherUserId;
	}
}
