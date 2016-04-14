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
	private $user;

	/**
	 * @param ProductsModel $productsModel
	 */
	public function __construct(ProductsModel $productsModel, $user)
	{
		parent::__construct();

		$this->productsModel = $productsModel;
		$this->user = $user;
	}

	/**
	 * @param \Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);
		if(isset($this->user)){
			$products = $this->productsModel->getAllUserProducts($this->user);
			$temp = array();
			foreach ($products as $product)
			{
				$product->from = $this->productsModel->getCityName($product->from)->name;
				$product->to = $this->productsModel->getCityName($product->to)->name;
				$temp[] = $product;
			}
			$this->setModel($temp);
		} else {
			$products = $this->productsModel->getAllProducts();
			foreach ($products as $product)
			{
				$product->from = $this->productsModel->getCityName($product->from)->name;
				$product->to = $this->productsModel->getCityName($product->to)->name;
				$temp[] = $product;
			}
			$this->setModel($temp);
		}
		
		$this->setPrimaryKey($this->productsModel->getPrimaryKeyName());
		$this->setRememberState(TRUE);
		$this->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_INNER);

		$this->addColumnText('name', 'Názov produktu')
			->setSortable()
			->setFilterText();

		$this->addColumnText('amount', 'Počet')
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
		
		$this->addColumnDate('date', 'Dátum prepravy')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('priority', 'Priorita')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('price', 'Cena za kus')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('info', 'Info')
			->setSortable()
			->setFilterText();
		
		$this->addActionHref('edit', '')
            ->setIcon('pencil')
            ->getElementPrototype()->setTitle('Upraviť');

        $this->addActionHref('delete', '', 'delete!')
            ->setIcon('trash icon-white')
            ->setConfirm('Naozaj chcete odstrániť záznam?')
            ->setElementPrototype(
                Html::el('a')
                    ->addClass('btn btn-danger btn-mini')
                    ->setTitle('Zmazať'));
	}
}
