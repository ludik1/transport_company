<?php

namespace AdminModule\Datagrids;

use Models\ProductsModel,
	Nette\Utils\Html;

class ProductsGrid extends \FRI\Application\UI\Controls\BaseGrid
{
	/**
	 * @var ProductsModel
	 */
	private $productsModel;


	/**
	 * @param ProductsModel $productsModel
	 */
	public function __construct(ProductsModel $productsModel)
	{
		parent::__construct();

		$this->productsModel = $productsModel;
	}

	/**
	 * @param \Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);

		$this->setModel($this->productsModel->getAllCars());
		$this->setPrimaryKey($this->productsModel->getPrimaryKeyName());
		$this->setRememberState(TRUE);
		$this->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_INNER);

		$this->addColumnText('car_id', 'Evidenčné číslo')
			->setSortable();

		$this->addColumnText('user_id', 'ID šoféra')
			->setSortable()
			->setFilterText();

		$this->addColumnText('weight', 'Maximálna váha')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('size', 'Maximálna veľkosť')
			->setSortable()
			->setFilterText();
	}
}
