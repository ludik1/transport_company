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
	
	public function insertCar($values)
	{
		$this->db->insert($this->table, $values)->execute();
	}
	
	public function updateDriver($values)
	{
		$this->db->query('UPDATE car SET user_id='.$values->user_id.' WHERE car_id="'.$values->car_id.'"');
	}
}