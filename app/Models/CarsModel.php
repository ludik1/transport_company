<?php

namespace Models;

final class CarsModel extends BaseModel
{

	protected function setup()
	{
		$this->table = 'car';
		$this->primaryKey = 'car_id';
	}
	
	public function getAllCars()
	{
		return $this->db->select('*')->from($this->table)->fetchAll();
	}
}