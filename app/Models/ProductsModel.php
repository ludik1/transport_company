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
}