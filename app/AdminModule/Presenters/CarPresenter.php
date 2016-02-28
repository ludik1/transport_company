<?php

namespace App\AdminModule\Presenters;

use Models\CarsModel,
	Models\UsersModel,
	AdminModule\Datagrids\CarsGrid,
	FrontModule\Forms\CarForm,
	FrontModule\Forms\DriverForm;

class CarPresenter extends BasePresenter
{
	/**
	 * @var CarsModel
	 */
	private $carsModel;
	/**
	 * @var UsersModel 
	 */
	private $usersModel;

	/**
	 * @param CarsModel $carsModel
	 * @param UsersModel $usersModel
	 */
	public function __construct(CarsModel $carsModel, UsersModel $usersModel)
	{
		parent::__construct();

		$this->usersModel = $usersModel;
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
		$form = new CarForm($this->usersModel->getDrivers());
		$form->onSuccess[] = $this->carFormSubmitted;
		
		return $form;
	}
	
	public function carFormSubmitted(CarForm $form)
	{
		$values = $form->getValues();
		
		$this->carsModel->insertCar($values);
		
		$this->flashMessage('Vozidlo bolo úspešne pridané!');
		$this->redirect(':Admin:Car:default');
	}
	
	protected function createComponentDriverForm()
	{
		$form = new DriverForm($this->usersModel->getDrivers(), $this->carsModel->getAllCars());
		$form->onSuccess[] = $this->driverFormSubmitted;
		
		return $form;
	}
	
	public function driverFormSubmitted(DriverForm $form)
	{
		$values = $form->getValues();

		$this->carsModel->updateDriver($values);
		
		$this->flashMessage('Vozidlo bolo úspešne pridané!');
		$this->redirect(':Admin:Car:default');
	}
}

