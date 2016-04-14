<?php

namespace Models;

final class ProductsModel extends BaseModel
{

	protected function setup()
	{
		$this->table = 'product';
		$this->primaryKey = 'product_id';
	}
	
	public function getAllProducts()
	{
		return $this->db->select('*')->from($this->table)->fetchAll();
	}
	
	public function getAllUserProducts($userId)
	{
		return $this->db->select('*')->from($this->table)->where('user_id='.$userId)->fetchAll();
	}
	
	public function getProductForTransport($date, $type, $sort)
	{
		return $this->db->select('*')->from($this->table.' ORDER BY '.$type.' '.$sort)->fetchAll();// WHERE date="$date"
	}
	public function getArea($product)
	{
		$result = $this->db->select('area')->from('cities')->where('id=','"'.$product->from.'"')->fetch();
		return $result->area;
	}
	
	public function getCities()
	{
		return $this->db->select('*')->from('cities')->fetchPairs('id', 'name');	
	}
	
	public function getCityId($name)
	{
		return $this->db->select('id')->from('cities')->where('name=','"'.$name.'"')->fetch();	
	}
	public function getCityName($id)
	{
		return $this->db->select('name')->from('cities')->where('id=',(int)$id)->fetch();	
	}
}