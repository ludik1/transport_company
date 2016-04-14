<?php

namespace Models;

final class OrdersModel extends BaseModel
{
	protected function setup()
	{
		$this->table = 'orders';
		$this->primaryKey = '';
	}
	
	public function getOrders()
	{
		return $this->db->select('*, product_id as id')->from($this->table)->join('product')->using('( product_id) ')->fetchAll();
	}
	
	public function insertOrders($data)
	{
		foreach ($data as $order)
		{
			unset($order['product_name']);
			unset($order['car_free_size']);
			$this->db->insert($this->table, $order)->execute();
		}
	}
}