<?php

namespace Models;

final class UsersModel extends BaseModel
{
	const USER_DATA = 'user_data';
	const USER_ROLES = 'user_roles';
	const ROLE = 'role';

	protected function setup()
	{
		$this->table = 'users';
		$this->primaryKey = 'user_id';
	}
	
	public function getAllUsers()
	{
		return $this->db->select('u.user_id, ud.name, ud.surname, ud.personal_id, ud.email, ud.address, u.employed_from, u.employed_to')->from($this->table)->as("u")->join(self::USER_DATA)->as("ud")->using('(user_id)')->fetchAll();
	}
	
	public function getUserRoles()
	{
		return $this->db->select('*')->from(self::ROLE)->fetchAll();
	}

	public function insertUser($values)
	{
		$user = array (
			'login' => $values->login,
			'password' => $values->password
				);		
		$this->db->insert($this->table, $user)->execute();
		
		$userData = array(
			'user_id' => $this->db->getInsertId(),
			'name' => $values->name,
			'surname' => $values->surname,
			'personal_id' => $values->personal_id,
			'email' => $values->email,
			'phone' => $values->phone,
			'address' => $values->address
		);
		$this->db->insert(self::USER_DATA, $userData)->execute();
		
		$userRole = array(
			'user_id' => $userData['user_id'],
			'role_id' => $values->role_id
		);
		$this->db->insert(self::USER_ROLES, $userRole)->execute();
	}
	
	public function getUsersLogin()
	{
		return $this->db->select('login')->from($this->table)->fetchAll();
	}
	
	public function getDrivers()
	{
		return $this->db->select('u.user_id, ud.name, ud.surname, role_id')->from($this->table)->as("u")->join(self::USER_DATA)->as("ud")->using('(user_id)')->join(self::USER_ROLES)->as("ur")->using('(user_id)')->where('role_id=2')->fetchAll();
	}
}