<?php

namespace AdminModule\Datagrids;

use Models\OrdersModel,
	Nette\Utils\Html,
	App\AdminModule\Presenters\OptimalizationPresenter;

class DistributionPlanGrid extends \FRI\Application\UI\Controls\BaseGrid
{	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param \Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);
		if(isset($_SESSION['data']))
		{
			$this->setModel($_SESSION['data']);
		}
		else
		{
			$this->setModel(array());
		}
		
		$this->setDefaultPerPage(500);
		//$this->setPrimaryKey($this->productsModel->getPrimaryKeyName());
		$this->setRememberState(TRUE);
		$this->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_INNER);

		$this->addColumnText('car_id', 'Evidenčné číslo auta')
			->setSortable()
			->setFilterText();

		$this->addColumnText('car_free_size', 'Voľná kapacita')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('car_free_weight', 'Voľná kapacita')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('product_id', 'ID produktu')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('product_name', 'Názov produktu')
			->setSortable()
			->setFilterText();

		$this->addColumnText('product_amount', 'Počet produktu')
			->setSortable()
			->setFilterText();
	}
}
