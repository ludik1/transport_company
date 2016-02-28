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

		$this->setModel($this->productsModel->getAllProducts());
		$this->setPrimaryKey($this->productsModel->getPrimaryKeyName());
		$this->setRememberState(TRUE);
		$this->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_INNER);

		$this->addColumnText('name', 'Názov produktu')
			->setSortable()
			->setFilterText();

		$this->addColumnText('count', 'Počet')
			->setSortable()
			->setFilterText();

		$this->addColumnText('weight', 'Váha')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('size', 'Veľkosť')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('from', 'Odvoz z mesta')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('to', 'Odvoz do mesta')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('date', 'Dátum prepravy')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('priority', 'Priorita')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('info', 'Info')
			->setSortable()
			->setFilterText();
	}
}
