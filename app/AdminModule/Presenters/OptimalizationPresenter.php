<?php

namespace App\AdminModule\Presenters;

use Nette\Utils\DateTime,
	Models\CarsModel,
	Models\ProductsModel,
	Models\OrdersModel,
	FrontModule\Forms\OptimalizationForm,
	FrontModule\Forms\DistributionPlanForm,
	AdminModule\Datagrids\OrdersGrid,
	AdminModule\Datagrids\DistributionPlanGrid,
	AdminModule\Datagrids\DriverGrid;

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
	* @return DriverGrid
	*/
	protected function createComponentDriverGrid()
    {
		$grid = new DriverGrid($this->ordersModel, $this->productsModel);
		
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
		ini_set('max_execution_time',500);
		if($this->ordersModel->distributionPlanIsCreated())
		{
			$this->flashMessage('Plán rozvozu bol už na dnes vytorený', 'wrong');
			$this->redirect('Optimalization:');
		}
		else
		{	
			if(empty($_SESSION['data']))
			{
				$this->flashMessage('Plán rozvozu sa nepodarilo vytvoriť', 'wrong');
			}
			else
			{
				$products_ids = array();
				foreach ($_SESSION['data'] as $temp)
				{
					$add = true;
					foreach ($products_ids as $temp1)
					{
						if($temp1 == $temp['product_id'])
						{
							$add = false;
						}
					}
					if($add) $products_ids[] = $temp['product_id'];
				}

				foreach ($products_ids as $temp)
				{
					$data = $this->productsModel->getProduct($temp);
					$this->productsModel->update($data->product_id, array('status' => 1));
					mail($data->email, 'Objednavka cislo'.$data->product_id , 'Vaša objednávka s číslom '.$data->product_id.' bude dnes doručená.', 'From: ltranstransportcompany@gmail.com');
				}
				$this->ordersModel->insertOrders($_SESSION['data']);
				$_SESSION['data'] = array();
				$this['distributionPlanGrid']->setModel($_SESSION['data']);
				$this['distributionPlanGrid']->redrawControl();
				$this->flashMessage('Plán rozvozu bol úspešne vytvorený', 'success');
				$this->redirect('Optimalization:');
			}
		}		
	}
	public function optimalizationFormSubmitted(OptimalizationForm $form)
	{
		if($this->ordersModel->distributionPlanIsCreated())
		{
			$this->flashMessage('Plán rozvozu bol už na dnes vytorený', 'wrong');
			$this->redirect('Optimalization:');
		}
		else
		{		
			$values = $form->getValues();
			$date = new \Nette\Utils\DateTime();
			$cars = $this->carsModel->getCarsForTransport($date);
			$date = $date->format('Y.m.d');
			foreach ($cars as $car)
			{
				$car['area'] = 0;
				$car['products'] = array();
			}
			$this->cars = json_decode(json_encode($cars), true);

			$products = $this->productsModel->getProductForTransport($date, $values->type, $values->sort);

			$products_with_area = array();
			foreach ($products as $product)
			{
				$product['area'] = $this->productsModel->getArea($product);
				$products_with_area[] = $product;
			}
			// najprv budem vyberat podla krajov cize 1-8...
			// podla toho na com chcem mat vacsiu prioritu, podla toho vytvaram values (ak chcem usporiadat len podla priority - nastavim value = priority)
			$this->optimalizeAlgorithm($products_with_area, $values->split);
		}
	}

	private function optimalizeAlgorithm($products, $split)
	{		
		foreach ($products as $product)
		{
			for($i = 0; $i< count($this->cars); $i++)
			{
				if($split == "true")
				{
					if(($this->cars[$i]['area']== 0 || $this->cars[$i]['area']==$product['area']) 
							&& $product['amount']>0 && $this->cars[$i]['size'] >= $product['size'] && $this->cars[$i]['weight'] >= $product['weight'])
					{
						$can_have = floor($this->cars[$i]['size']/$product['size']);
						if(floor($this->cars[$i]['weight']/$product['weight']) < $can_have) $can_have = floor($this->cars[$i]['weight']/$product['weight']);
						
						if($can_have > $product['amount'])
						{
							$this->cars[$i]['size'] -= $product['size']*$product['amount'];
							$this->cars[$i]['weight'] -= $product['weight']*$product['amount'];
							$inserted_count = $product['amount'];
						}
						else
						{
							$this->cars[$i]['size'] -= $can_have*$product['size'];
							$this->cars[$i]['weight'] -= $can_have*$product['weight'];
							$inserted_count = $can_have;
						}
						$product['amount'] -= $inserted_count;						
						$this->cars[$i]['products'][] = array (
								'product_id' => $product['product_id'],
								'product_amount' => $inserted_count,
								'product_name' => $product['name'],
									);
						if($this->cars[$i]['area'] == 0)
						{
							$this->cars[$i]['area'] = $product['area'];
						}	
					}
				}
				else
				{
					if((($this->cars[$i]['area']== 0 || $this->cars[$i]['area']==$product['area']) && $product['amount']>0) && $this->cars[$i]['weight'] >= $product['weight']
							&&($this->cars[$i]['size'] >= $product['size']*$product['amount'] || $product['amount']*$product['size'] > 100))
					{
						$can_have = floor($this->cars[$i]['size']/$product['size']);
						if(floor($this->cars[$i]['weight']/$product['weight']) < $can_have) $can_have = floor($this->cars[$i]['weight']/$product['weight']);
						
						if($can_have > $product['amount'])
						{
							$this->cars[$i]['size'] -= $product['size']*$product['amount'];
							$this->cars[$i]['weight'] -= $product['weight']*$product['amount'];
							$inserted_count = $product['amount'];
						}
						else
						{
							$this->cars[$i]['size'] -= $can_have*$product['size'];
							$this->cars[$i]['weight'] -= $can_have*$product['weight'];
							$inserted_count = $can_have;
						}

						$product['amount'] -= $inserted_count;
						$this->cars[$i]['products'][] = array (
								'product_id' => $product['product_id'],
								'product_amount' => $inserted_count,
								'product_name' => $product['name'],
									);
						if($this->cars[$i]['area'] == 0)
						{
							$this->cars[$i]['area'] = $product['area'];
						}	
					}
				}				
			}
		}
		
		$data = array();
		
		foreach ($this->cars as $temp)
		{
			foreach ($temp['products'] as $product)
			{
				$temp1['car_id'] = $temp['car_id'];
				$temp1['car_free_size'] = $temp['size']. ' m³';
				$temp1['car_free_weight'] = $temp['weight']. ' kg';
				$temp1['product_id'] = $product['product_id'];
				$temp1['product_name'] = $product['product_name'];
				$temp1['product_amount'] = $product['product_amount'];
				
				$data[] = $temp1;
			}
		}
		$_SESSION['data'] = $data;
		
		$this['distributionPlanGrid']->setModel($data);
		$this['distributionPlanGrid']->redrawControl();
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
	
	/**
     * @param int $order_id
     */
    public function actionAdd($order_id)
    {
		ini_set('max_execution_time',500);
		$data = $this->ordersModel->getOrder($order_id);		
		$product = $this->productsModel->getProduct($data->product_id);
		$orders = $this->ordersModel->getOrdersProduct($data->product_id);
		$amount = $data->product_amount;
		foreach ($orders as $temp)
		{
			$amount += $temp->product_amount;
		}
		if($product->amount == $amount)
		{
			$this->productsModel->update($data->product_id, array('status' => 2));
			mail($product->email, 'Objednavka cislo'.$product->product_id , 'Celá Vaša objednávka s číslom '.$product->product_id.' bola úspešne doručená.', 'From: ltranstransportcompany@gmail.com');	
		
		}
		else
		{
			mail($product->email, 'Objednavka cislo'.$product->product_id , 'Časť Vašej objednávky s číslom '.$product->product_id.' a množstvom '.$data->product_amount.' bolo úspešne doručené.', 'From: ltranstransportcompany@gmail.com');	
		}
		$this->ordersModel->update($order_id, array('delivered' => new DateTime()));
		$this->flashMessage('Objednávka bola doručená!', 'success');
        $this->redirect('Optimalization:driver');
    }
}

