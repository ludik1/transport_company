<?php

namespace AdminModule\Datagrids;

use Models\OrdersModel,
	Nette\Utils\Html;

class OrdersGrid extends \Hyp\Application\UI\Controls\BaseGrid
{
	/**
	 * @var OrdersModel
	 */
	private $ordersModel;
	private $user;

	/**
	 * @param OrdersModel $ordersModel
	 */
	public function __construct(OrdersModel $ordersModel)
	{
		parent::__construct();

		$this->ordersModel = $ordersModel;
	}

	/**
	 * @param \Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);
		$this->setModel($this->ordersModel->getOrders());
			
		//$this->setPrimaryKey($this->productsModel->getPrimaryKeyName());
		$this->setRememberState(TRUE);
		$this->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_INNER);

		$this->addColumnText('car_id', 'Evidenčné číslo auta')
			->setSortable()
			->setFilterText();

		$this->addColumnText('product_id', 'ID objednávky')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('name', 'Názov produktu')
			->setSortable()
			->setFilterText();

		$this->addColumnText('product_amount', 'Počet')
			->setSortable()
			->setFilterText();
		
		$this->addColumnDate('date', 'Dátum vyhotovenia')
			->setSortable()
			->setFilterText();
		$this->addColumnText('delivered', 'Doručené')
			->setSortable()
			->setFilterText();
	}
}
