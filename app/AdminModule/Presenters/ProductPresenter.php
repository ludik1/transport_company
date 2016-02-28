<?php

namespace App\AdminModule\Presenters;

use Models\ProductsModel,
	AdminModule\Datagrids\ProductsGrid,
	FrontModule\Forms\ProductForm;

class ProductPresenter extends BasePresenter
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
	
	public function actionDefault()
	{		
		$this->template->products = $this->productsModel->getAllProducts();
	}
	
	/**
	* @return ProductGrid
	*/
	protected function createComponentProductsGrid()
	{
	    $grid = new ProductsGrid($this->productsModel);

	    return $grid;
	}
	
	protected function createComponentProductForm()
	{
		$form = new ProductForm();
		$form->onSuccess[] = $this->productFormSubmitted;
		return $form;
	}
	
	public function productFormSubmitted(ProductForm $form)
	{
		$values = $form->getValues();
		$values->user_id = $this->user->getId();
		
		$this->productsModel->insert($values);
		
		$this->flashMessage('Produkt bol úspešne vložený!');
		$this->redirect(':Admin:Product:default');
	}
}

