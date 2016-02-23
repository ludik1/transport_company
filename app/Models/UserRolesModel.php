<?php

namespace Models;

final class UserRolesModel extends BaseModel
{
	protected function setup()
	{
		$this->table = 'user_roles';
		$this->primaryKey = 'user_id';
	}
	
	public function getUserRoles($userId)
	{
		return $this->db->select('role_id')->from($this->table)->where('user_id=?', $userId)->fetchAll();
	}
}