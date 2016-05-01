<?php

namespace Models;

use Hyp\Forms\Controls\Date;

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
		$data = $this->db->select('u.user_id, ud.name, ud.surname, ud.personal_id, ud.email, ud.address, u.employed_from, u.employed_to, r.name as role_name')->from($this->table)->as("u")->join(self::USER_DATA)->as("ud")->using('(user_id)')->join(self::USER_ROLES)->as("ur")->using('(user_id)')->join(self::ROLE)->as("r")->using('(role_id)')->fetchAll();
		$result = array();
		foreach ($data as $temp)
		{
			if(isset($temp->employed_from))
			$temp->employed_from = $temp->employed_from->format('d.m.Y');
			if(isset($temp->employed_to))
			$temp->employed_to = $temp->employed_to->format('d.m.Y');
			$result[] = $temp;
		}
		return $result;
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
		$users = $this->db->select('u.user_id, ud.name, ud.surname, role_id')->from($this->table)->as("u")->join(self::USER_DATA)->as("ud")->using('(user_id)')->join(self::USER_ROLES)->as("ur")->using('(user_id)')->where('role_id=2')->fetchAll();
	
		$cars = $this->db->select('user_id')->from('car')->fetchAll();
		
		$arr = array();
		
		foreach ($users as $user)
		{
			$add = TRUE;
			foreach ($cars as $car)
			{
				if($car->user_id == $user->user_id) $add = FALSE;
			}
			if($add) $arr[$user->user_id] = $user->name.' '.$user->surname;
		}
		return $arr;
	}
	public function getUser($user_id)
	{
		return $this->db->select('*')->from($this->table)->join(self::USER_DATA)->using('(user_id)')->join(self::USER_ROLES)->using('(user_id)')->where('user_id=', $user_id)->fetch();
	}
	
	public function updateUser($user_id, $values)
	{
		$data = array('role_id' => $values->role_id);
		$this->db->update(self::USER_ROLES, $data)->where('user_id =',$user_id)->execute();
		unset($values->role_id);
		$this->db->update(self::USER_DATA, $values)->where('user_id =',$user_id)->execute();
	}
	public function getDriverEdit($user)
	{
		$userData = $this->db->select('*')->from('car')->join(self::USER_DATA)->using('(user_id)')->where('car_id="'.$user.'"')->fetch();
		if (!$userData) return false;
		return array('user_id' => $userData->user_id);
	}
	
	public function getDriversEdit($user)
	{
		$userData = $this->db->select('*')->from('car')->join(self::USER_DATA)->using('(user_id)')->where('car_id="'.$user.'"')->fetch();
		$arr = array('0' => 'Nepriradiť žiadného');
		if ($userData)$arr[$userData->user_id] = $userData->name.' '.$userData->surname;
		

		$users = $this->db->select('u.user_id, ud.name, ud.surname, role_id')->from($this->table)->as("u")->join(self::USER_DATA)->as("ud")->using('(user_id)')->join(self::USER_ROLES)->as("ur")->using('(user_id)')->where('role_id=2')->fetchAll();
	
		$cars = $this->db->select('user_id')->from('car')->fetchAll();
		
		
		
		foreach ($users as $user)
		{
			$add = TRUE;
			foreach ($cars as $car)
			{
				if($car->user_id == $user->user_id) $add = FALSE;
			}
			if($add) $arr[$user->user_id] =$user->name.' '.$user->surname;
		}
		return $arr;
	}
}