<?php

namespace Models;

use Nette\Utils\DateTime;

final class OrdersModel extends BaseModel
{
	protected function setup()
	{
		$this->table = 'orders';
		$this->primaryKey = 'order_id';
	}
	
	public function getOrders()
	{
		$result = array();
		$data = $this->db->select('*, product_id as id')->from($this->table)->join('product')->using('( product_id) ')->fetchAll();
		foreach ($data as $temp)
		{
			if (isset($temp->delivered)) $temp->delivered = $temp->delivered->format('d.m.Y H:s');
			$result[] = $temp;
		}
		return $result;
	}
	
	public function getOrder($order_id)
	{
		return $this->db->select('*')->from($this->table)->where('order_id=', $order_id)->fetch();
	}
	
	public function getOrdersProduct($product_id)
	{
		return $this->db->select('*')->from($this->table)->where('product_id=', $product_id)->where('delivered IS NOT NULL')->fetchAll();
	}
	
	public function insertOrders($data)
	{
		foreach ($data as $order)
		{
			unset($order['product_name']);
			unset($order['car_free_size']);
			unset($order['car_free_weight']);
			$this->db->insert($this->table, $order)->execute();
		}
	}
	public function getDriverOrders($user_id)
	{
		$date = new DateTime();
		$from = '"'.$date->format('Y.m.d').' 00:00:00"';
		$to = '"'.$date->format('Y.m.d').' 23:59:00"';
		return $this->db->select('*, product_id as id')->from($this->table)->as('o')->join('product')->as('p')->using('( product_id) ')->join('car')->as('c')->using('( car_id) ')->where('c.user_id='.$user_id.' AND o.date>'.$from.' AND o.date<'.$to)->fetchAll();
	}
	public function distributionPlanIsCreated()
	{
		$date = new DateTime();
		$from = '"'.$date->format('Y.m.d').' 00:00:00"';
		$to = '"'.$date->format('Y.m.d').' 23:59:00"';
		$data = $this->db->select('*')->from($this->table)->where('date>'.$from.' AND date<'.$to)->fetchAll();
		if(isset($data[0]))	return true;
		return false;
	}
}