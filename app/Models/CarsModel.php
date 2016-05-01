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
		$data = $this->db->select('*')->from($this->table)->leftJoin('user_data')->using('(user_id)')->orderBy('car_id DESC')->fetchAll();
		$result = array();
		foreach ($data as $temp)
		{
			$temp->size = $temp->size.' m³';
			$temp->weight = $temp->weight.' kg';
			$temp->fullname = $temp->name.' '.$temp->surname;
			$result[] = $temp;
		}
		return $result;
	}
	public function deleteCar($car_id)
	{
		$this->db->delete($this->table)->where('car_id="'.$car_id.'"')->execute();
	}

	public function getFreeCars()
	{
		return $this->db->select('*')->from($this->table)->where('user_id IS NULL')->fetchPairs('car_id', 'car_id');
	}
	
	public function insertCar($values)
	{
		$this->db->insert($this->table, $values)->execute();
	}
	
	public function updateDriver($values)
	{
		$this->db->query('UPDATE car SET user_id='.$values->user_id.' WHERE car_id="'.$values->car_id.'"');
	}
	
	public function updateCar($car_id, $values)
	{
			$this->db->update($this->table, $values)->where('car_id ="'.$car_id.'"')->execute();
	}
	
	public function getCarsForTransport($date)
	{		
		$result = array();
		$data = $this->db->select('*')->from($this->table)->where('user_id IS NOT NULL')->fetchAll();
		foreach ($data as $row)
		{
			if(!($row->reserved_from <= $date && $row->reserved_to >= $date))
			{
				$result[] = $row;
			}			
		}
		return $result;
	}
	
	public function getDriverData($car_id)
	{
		return $this->db->select('*')->from($this->table)->join('user_data')->using('(user_id)')->where('car_id="'.$car_id.'"')->fetch();
	}
}