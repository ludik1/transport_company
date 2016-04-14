<?php

namespace App\AdminModule\Presenters;

use Models\CarsModel,
	Models\ProductsModel,
	Models\OrdersModel,
	FrontModule\Forms\OptimalizationForm,
	FrontModule\Forms\DistributionPlanForm,
	AdminModule\Datagrids\OrdersGrid,
	AdminModule\Datagrids\DistributionPlanGrid;

class OptimalizationPresenter extends BasePresenter
{
	/**
	 * @var CarsModel
	 */
	private $carsModel;
	/**
	 * @var ProductsModel 
	 */
	private $productsModel;
	/**
	 * @var OrdersModel 
	 */
	private $ordersModel;
	/**
	 * @var array 
	 */
	private $cars;
	/**
	 * @var array 
	 */
	private $distributionPlan;

	/**
	 * @param CarsModel $carsModel
	 * @param ProductsModel $productsModel
	 * @param OrdersModel $ordersModel
	 */
	public function __construct(CarsModel $carsModel, ProductsModel $productsModel, OrdersModel $ordersModel)
	{
		parent::__construct();

		$this->productsModel = $productsModel;
		$this->carsModel = $carsModel;
		$this->ordersModel = $ordersModel;
	}

	/**
	* @return OrdersGrid
	*/
	protected function createComponentOrdersGrid()
    {
		$grid = new OrdersGrid($this->ordersModel);
		
		return $grid;		
	}
	
	/**
	* @return DistributionPlanGrid
	*/
	protected function createComponentDistributionPlanGrid($type)
    {
		$grid = new DistributionPlanGrid();
		
		return $grid;	
	}
	protected function createComponentOptimalizationForm()
	{
		$form = new OptimalizationForm();
		$form->onSuccess[] = $this->optimalizationFormSubmitted;
		return $form;
	}
	
	protected function createComponentDistributionPlanForm()
	{
		$form = new DistributionPlanForm();
		$form->onSuccess[] = $this->distributionPlanSubmitted;
		return $form;
	}
	
	public function distributionPlanSubmitted(DistributionPlanForm $form)
	{
		$this->ordersModel->insertOrders($_SESSION['data']);
		$_SESSION['data'] = array();
		$this['distributionPlanGrid']->setModel($_SESSION['data']);
		$this['distributionPlanGrid']->redrawControl();
		$this->flashMessage('Plán rozvozu bol úspešne vytvorený', 'success');
	}
	public function optimalizationFormSubmitted(OptimalizationForm $form)
	{
		$values = $form->getValues();
		$date = date("Y-m-d").' 00:00:00';
		$cars = $this->carsModel->getCarsForTransport($date);
		foreach ($cars as $car)
		{
			$car['area'] = 0;
			$car['products'] = array();
		}
		$this->cars = json_decode(json_encode($cars), true);

		$products = $this->productsModel->getProductForTransport($date, $values->type, $values->sort);
		foreach ($products as $product)
		{
			$product['area'] = $this->productsModel->getArea($product);
			$products_with_area[] = $product;
		}
		// najprv budem vyberat podla krajov cize 1-8...
		// podla toho na com chcem mat vacsiu prioritu, podla toho vytvaram values (ak chcem usporiadat len podla priority - nastavim value = priority)
		$this->optimalizeAlgorithm($products_with_area, $values->split);		

		
//		foreach ($this->cars as $temp)
//		{
//			dump($temp);
//		}
//		die();
//		foreach($temp as $x => $x_value) {
//			echo "Key=" . $x . ", Value=" . $x_value;
//			echo "<br>";
//	   }die();
//		dump($temp);
//		$add = TRUE;
//		$i = 0;
//		dump($cars);
//		dump($cars[$i]);
//		die();
//		
//		foreach ($products as $product)
//		{
//			while($add)
//			{
//				
//			}
//		}
//		dump($products);
//		dump($cars);die();
//		$this->flashMessage('Optimalizácia prebehla úspešne!');
//		dump($grid);die();
	}

	private function optimalizeAlgorithm($products, $split)
	{
		if($split == "true")
		{
			foreach ($products as $product)
			{
				for($i = 0; $i< count($this->cars); $i++)
				{
					if(($this->cars[$i]['area']== 0 || $this->cars[$i]['area']==$product['area']) && $product['amount']>0 && $this->cars[$i]['size'] >= $product['size'])
					{
						$can_have = floor($this->cars[$i]['size']/$product['size']);

						if($can_have > $product['amount'])
						{
							$this->cars[$i]['size'] -= $product['size']*$product['amount'];
							$inserted_count = $product['amount'];
						}
						else
						{
							$this->cars[$i]['size'] -= $can_have*$product['size'];
							$inserted_count = $can_have;
						}
						$product['amount'] -= $inserted_count;
						$this->cars[$i]['area'] = $product['area'];
						$this->cars[$i]['products'][] = array (
								'product_id' => $product['product_id'],
								'product_amount' => $inserted_count,
								'product_name' => $product['name'],
									);
					}
				}
			}
		}
		else
		{
			foreach ($products as $product)
			{
				for($i = 0; $i< count($this->cars); $i++)
				{
					if(($this->cars[$i]['area']== 0 || $this->cars[$i]['area']==$product['area']) && $product['amount']>0 && $this->cars[$i]['size'] > 0)
					{
						
						if($this->cars[$i]['size'] >= $product['size']*$product['amount'] || $product['amount']*$product['size'] > 100)
						{
							$can_have = floor($this->cars[$i]['size']/$product['size']);
							
							if($can_have > $product['amount'])
							{
								$this->cars[$i]['size'] -= $product['size']*$product['amount'];
								$inserted_count = $product['amount'];
							}
							else
							{
								$this->cars[$i]['size'] -= $can_have*$product['size'];
								$inserted_count = $can_have;
							}

							$product['amount'] -= $inserted_count;
							$this->cars[$i]['area'] = $product['area'];
							$this->cars[$i]['products'][] = array (
									'product_id' => $product['product_id'],
									'product_amount' => $inserted_count,
									'product_name' => $product['name'],
										);
						}
					}
				}
			}
		}
		
		foreach ($this->cars as $temp)
		{
			foreach ($temp['products'] as $product)
			{
				$temp1['car_id'] = $temp['car_id'];
				$temp1['car_free_size'] = $temp['size']. ' m³';
				$temp1['product_id'] = $product['product_id'];
				$temp1['product_name'] = $product['product_name'];
				$temp1['product_amount'] = $product['product_amount'];
				
				$data[] = $temp1;
			}
		}
		$_SESSION['data'] = $data;
		
//		$_SESSION['data'] = $data;
		$this['distributionPlanGrid']->setModel($data);
		$this['distributionPlanGrid']->redrawControl();
		//dump($this['distributionPlanGrid']);
//		die();
//		
//		$this->distributionPlan = $this->cars;
//		foreach ($this->cars as $temp)
//		{
//			dump($temp);
//		}
//		die();
//		
//		
//		$car_id = 0;
//		while (count($sorted_products) > 0 && $this->cars[count($this->cars)-1]['avaible'])
//		{
//			for($i = 0; $i< count($this->cars); $i++)
//			{
//				if($this->cars[$i]['avaible'])
//				{
//					$car_id = $i;
//					$this->cars[$i]['avaible'] = false;
//					break;
//				}
//			}
////			foreach ($sorted_products as $product)
////			{
//			for($i = 0; $i < count($sorted_products); $i++)
//			{
//				if($sorted_products[$i]['amount'] > 0 && $this->cars[$car_id]['size'] > $sorted_products[$i]['size'])
//				{	
//					$can_have = floor($this->cars[$car_id]['size']/$sorted_products[$i]['size']);
//					
//					if($can_have > $sorted_products[$i]['amount'])
//					{
//						$this->cars[$car_id]['size'] -= $sorted_products[$i]['size']*$sorted_products[$i]['amount'];
//						$inserted = $sorted_products[$i]['amount'];
//					}
//					else
//					{
//						$this->cars[$car_id]['size'] -= $can_have*$sorted_products[$i]['size'];
//						$inserted = $can_have;
//					}
//					
//					$sorted_products[$i]['amount'] -= $inserted;
//					$this->cars[$car_id]['products'][] = array (
//							'product_id' => $sorted_products[$i]['id'],
//							'products_amount' => $inserted
//								);
////					if($sorted_products[$i]['size']*$sorted_products[$i]['amount'] < $this->cars[$car_id]['size'])
////					{
////						$this->cars[$car_id]['size'] -=  $sorted_products[$i]['size']*$sorted_products[$i]['amount'];
////						$this->cars[$car_id]['products'][] = array (
////							'product_id' => $sorted_products[$i]['id'],
////							'products_amount' => $sorted_products[$i]['amount']
////								);
////						$sorted_products[$i]['amount'] = 0;
////					}
////					else if(floor($this->cars[$car_id]['size']/$sorted_products[$i]['size']) > 0)
////					{
////						$can_have = floor($this->cars[$car_id]['size']/$sorted_products[$i]['size']);
////						$this->cars[$car_id]['size'] -= $can_have*$sorted_products[$i]['size'];
////						//dump($sorted_products[$i]['amount']);
////						$sorted_products[$i]['amount'] -= $can_have;
////						//dump($sorted_products[$i]['amount']);
////						$this->cars[$car_id]['products'][] = array (
////							'product_id' => $sorted_products[$i]['id'],
////							'products_amount' => $can_have
////								);
////					}
//				}
//			}
//		}
//		for($i = 0; $i < count($this->cars); $i++)
//		{
//			if(empty($this->cars[$i]['products']))
//			{
//				$this->cars[$i]['avaible'] = true;
//			}
//		}
	}
	
	private function sortArray($products)
	{
		$temp = array();
		foreach ($products as $product)
		{
			$temp[$product['id']] = $product['value'];
		}
		arsort($temp);		
		$keys = array_keys($temp);
		$sorted_products = array();
		
		foreach ($keys as $key)
		{
			foreach ($products as $product)
			{
				if($key == $product['id'])
				{
					$sorted_products[] = $product;
				}
			}
		}
		return $sorted_products;
	}
}

