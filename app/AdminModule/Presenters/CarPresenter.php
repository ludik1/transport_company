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
	
	public function actionAdd()
	{
		$form = $this['carForm'];
		$form->addSubmit('ok', 'Pridať');
		$form->onSuccess[] = $this->carFormSubmitted;

		$this->template->title = 'Pridanie vozidla';
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
		$form = new DriverForm($this->usersModel->getDrivers(), $this->carsModel->getFreeCars());
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
	
	
	/**
     * @param int $car_id
     */
    public function actionEdit($car_id)
    {
        $car = $this->carsModel->find($car_id);
		if (!$car)
		{
			$this->error();
		}
		$this->template->car = $car_id;
		$form = $this['carForm'];
		$form->setDefaults($car);
		$form->addSubmit('ok', 'Upraviť');
		$form->onSuccess[] = $this->carFormEdit;
    }
	
	public function carFormEdit(CarForm $form)
    {
        $values = $form->getValues();
		unset($values->car_id);
		
        $this->carsModel->updateCar($this->template->car, $values);
		
        $this->flashMessage('Vozidlo bolo úspešne editované!');
        $this->redirect('Car:');
    }
	
	/**
     * @param int $car_id
     */
    public function handleDelete($car_id)
    {
        $this->carModel->delete($car_id);
		
		$this->flashMessage('Vozidlo bolo úspešne vymazané!');
        $this->redirect('Car:');
    }
}

