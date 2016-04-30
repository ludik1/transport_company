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
		return $this->db->select('*')->from($this->table)->orderBy('product_id DESC')->fetchAll();
	}
	
	public function getAllUserProducts($userId)
	{
		return $this->db->select('*')->from($this->table)->where('user_id='.$userId)->orderBy('product_id DESC')->fetchAll();
	}
	
	public function getProductForTransport($date, $type, $sort)
	{
		return $this->db->select('*')->from($this->table)->where('date="'.$date.'"')->orderBy($type.' '.$sort)->fetchAll();
	}
	public function getArea($product)
	{
		$result = $this->db->select('area')->from('cities')->where('city_id=','"'.$product->from.'"')->fetch();
		return $result->area;
	}
	
	public function getCities()
	{
		return $this->db->select('*')->from('cities')->fetchPairs('city_id', 'name');	
	}
	
	public function getCityId($name)
	{
		return $this->db->select('city_id')->from('cities')->where('name=','"'.$name.'"')->fetch();	
	}
	public function getCityName($id)
	{
		return $this->db->select('name')->from('cities')->where('city_id=',(int)$id)->fetch();
	}
	
	public function getProduct($id)
	{
		return $this->db->select('*')->from($this->table)->where('product_id=',$id)->join('user_data')->using('(user_id)')->fetch();
	}
}