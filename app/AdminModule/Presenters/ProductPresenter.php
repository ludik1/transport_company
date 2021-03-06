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
	
	public function actionAdd()
	{
		$form = $this['productForm'];
		$form->addSubmit('ok', 'Pridať');
		$form->onSuccess[] = $this->productFormSubmitted;

		$this->template->title = 'Pridanie produktu';
	}

	/**
	* @return ProductGrid
	*/
	protected function createComponentProductsGrid()
	{
		if($this->user->isInRole(1)) $grid = new ProductsGrid($this->productsModel, NULL);
		else $grid = new ProductsGrid($this->productsModel, $this->user->getId());

	    return $grid;
	}
	
	protected function createComponentProductForm()
	{
		$form = new ProductForm($this->productsModel->getCities());
		
		return $form;
	}
	
	public function productFormSubmitted(ProductForm $form)
	{
		$values = $form->getValues();
		$values->user_id = $this->user->getId();
		$weight = 0;
		if($values->size > 50) $weight = 2;
		$values->price = ($this->getSizePrice($values->size)*$values->size + $weight) * $this->getPriorityPrice($values->priority) * $values->amount;
		$this->productsModel->insert($values);
		
		$this->flashMessage('Produkt bol úspešne vložený!', 'success');
		$this->redirect(':Admin:Product:default');
	}
	
	private function getPriorityPrice($priority)
	{
		switch ($priority) {
			case 1:
				return 1.1;
			case 2:
				return 1.07;
			case 3:
				return 1.05;
			case 4:
				return 1.03;
			default:
				return 1;
		}
	}
	
	private function getSizePrice($size)
	{
		if($size < 20)
		{
			return 10;
		}
		else if($size < 50)
		{
			return 9;
		}
		else if($size < 100)
		{
			return 8;
		}
		else if($size < 200)
		{
			return 7;
		}
		else if($size < 500)
		{
			return 6;
		}
		return 5;
	}

	/**
     * @param int $product_id
     */
    public function actionEdit($product_id)
    {
        $product = $this->productsModel->find($product_id);
		if (!$product)
		{
			$this->error();
		}
		$this->template->product = $product_id;
		$form = $this['productForm'];
		$form->setDefaults($product);
		$form->addSubmit('ok', 'Upraviť');
		$form->onSuccess[] = $this->productFormEdit;
    }
	
	public function productFormEdit(ProductForm $form)
    {		
        $values = $form->getValues();
		$weight = 0;
		if($values->size > 50) $weight = 2;
		$values->price = ($this->getSizePrice($values->size)*$values->size + $weight) * $this->getPriorityPrice($values->priority) * $values->amount;
        $this->productsModel->update($this->template->product, $values);
		
        $this->flashMessage('Produkt bol úspešne editovaný!', 'success');
        $this->redirect('Product:');
    }

    /**
     * @param int $product_id
     */
    public function handleDelete($product_id)
    {
        $this->productsModel->delete($product_id);
		
		$this->flashMessage('Produkt bol úspešne vymazaný!', 'success');
        $this->redirect('Product:');
    }
}

