<?php

namespace AdminModule\Datagrids;

use Models\OrdersModel,
	Models\ProductsModel,
	Nette\Utils\Html;

class DriverGrid extends \Hyp\Application\UI\Controls\BaseGrid
{
	/**
	 * @var OrdersModel
	 */
	private $ordersModel;
	/**
	 * @var ProductsModel
	 */
	private $productsModel;
	private $user;

	/**
	 * @param OrdersModel $ordersModel
	 */
	public function __construct(OrdersModel $ordersModel, ProductsModel $productsModel)
	{
		parent::__construct();

		$this->ordersModel = $ordersModel;
		$this->productsModel = $productsModel;
	}

	/**
	 * @param \Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);
		$orders = $this->ordersModel->getDriverOrders($presenter->getUser()->getId());
		$driverPlan = array();
		foreach ($orders as $temp)
		{
			$temp->from = $this->productsModel->getCityName($temp->from)->name;
			$temp->to = $this->productsModel->getCityName($temp->to)->name;
			$driverPlan[] = $temp;
		}
		$this->setModel($driverPlan);
		
		$this->setPrimaryKey($this->ordersModel->getPrimaryKeyName());
		$this->setRememberState(TRUE);
		$this->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_INNER);
		
		$this->addColumnText('car_id', 'Evidenčné číslo auta')
			->setSortable()
			->setFilterText();

		$this->addColumnText('product_id', 'ID objednávky')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('name', 'Názov tovaru')
			->setSortable()
			->setFilterText();

		$this->addColumnText('product_amount', 'Počet')
			->setSortable()
			->setFilterText();
		
		$this->addColumnDate('date', 'Dátum dovozu')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('from', 'Odvoz z')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('to', 'Dovoz do')
			->setSortable()
			->setFilterText();
		
		$this->addActionHref('add', '')
			->setDisable(function($item) {
			if(isset($item->delivered))
			{
				return true;
			}
            return false;
            })
            ->setIcon('ok')
            ->getElementPrototype()->setTitle('Doručené');
	}
}
