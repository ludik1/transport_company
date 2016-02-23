<?php

namespace App\AdminModule\Presenters;

use Models\CarsModel,
	AdminModule\Datagrids\CarsGrid,
	FrontModule\Forms\CarForm;

class CarPresenter extends BasePresenter
{
	/**
	 * @var CarsModel
	 */
	private $carsModel;


	/**
	 * @param CarsModel $carsModel
	 */
	public function __construct(CarsModel $carsModel)
	{
		parent::__construct();

		$this->carsModel = $carsModel;
	}
	
	public function actionDefault()
	{		
		$this->template->cars = $this->carsModel->getAllCars();
	}
	
	/**
	* @return CarGrid
	*/
	protected function createComponentCarsGrid()
	{
	    $grid = new CarsGrid($this->carsModel);

	    return $grid;
	}
	
	protected function createComponentCarForm()
	{
		$form = new CarForm();
		$form->onSuccess[] = $this->carFormSubmitted;
		return $form;
	}
	
	public function carFormSubmitted(CarForm $form)
	{
		echo 'asdasdasdas';		
	}
}

