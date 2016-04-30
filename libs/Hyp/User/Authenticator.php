<?php

namespace Hyp\User;

/**
 * Logins every user that is found in database by username
 */
final class Authenticator implements \Nette\Security\IAuthenticator
{
	/** @var \Models\UsersModel */
	private $usersModel;
	/** @var \Models\UserRolesModel */
	private $userRolesModel;


	public function __construct(\Models\UsersModel $um, \Models\UserRolesModel $urm)
	{
		$this->usersModel = $um;
		$this->userRolesModel = $urm;
	}

	public function authenticate(array $credentials)
	{
		$user = $this->usersModel->findOneBy(['login' => $credentials[self::USERNAME], 'password' => $credentials[self::PASSWORD]]);

		if (!$user)
		{
			throw new \Nette\Security\AuthenticationException('Používateľ so zadaným UID neexistuje!');
		}

		$roles = array_keys($this->userRolesModel->findAll()->where('[user_id] = %i', $user->user_id)->fetchAssoc('role_id'));

		return new \Nette\Security\Identity($user->user_id, $roles, (array) $user);
	}
}
