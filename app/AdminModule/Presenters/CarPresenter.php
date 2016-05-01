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
		$isInserted = $this->carsModel->find($values->car_id);
		if (!empty($isInserted))
		{
			$this->flashMessage('Vozidlo s týmto EČV sa už nachádza v systéme!', 'wrong');
		}
		else
		{
			$this->carsModel->insertCar($values);
			$this->flashMessage('Vozidlo bolo úspešne pridané!', 'success');
			$this->redirect(':Admin:Car:default');			
		}		
	}
	
	protected function createComponentDriverForm()
	{
		$form = new DriverForm();
		//$form->onSuccess[] = $this->driverFormSubmitted;
		
		return $form;
	}
	
	public function actionAddDriver()
	{
		$form = $this['driverForm'];
		$form->addSelect('user_id', 'Šofér')
			->setPrompt('Vyberte prosím')
			->setItems($this->usersModel->getDrivers())
			->setRequired();
		$form->addSelect('car_id', 'Evidenčné číslo auta')
			->setPrompt('Vyberte prosím')
			->setItems($this->carsModel->getFreeCars())
			->setRequired();
		$form->addSubmit('ok', 'Pridať');
		$form->onSuccess[] = $this->driverFormSubmitted;

		$this->template->title = 'Pridanie šoféra';
	}
	
	public function driverFormSubmitted(DriverForm $form)
	{
		$values = $form->getValues();

		$this->carsModel->updateDriver($values);
		
		$this->flashMessage('Vozidlo bolo úspešne pridané!', 'success');
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
	
	/**
     * @param int $car_id
     */
    public function actionEditDriver($car_id)
    {
		$driver = $this->carsModel->getDriverData($car_id);
        $car = $this->usersModel->getDriversEdit($car_id);
		if (!$car)
		{
			$this->error();
		}
//		dump($car);die();
		$this->template->car = $car_id;
		$form = $this['driverForm'];
		$form->addSelect('user_id', 'Zmeniť šoféra na')
			->setRequired();
		$form['user_id']->setItems($car);
		if ($driver) $form->setDefaults($this->usersModel->getDriverEdit($car_id));
		$form->addSubmit('ok', 'Upraviť');
		$form->onSuccess[] = $this->driverFormEdit;
    }
	
	public function driverFormEdit(DriverForm $form)
    {
        $values = $form->getValues();
		unset($values->car_id);
		if ($values->user_id == 0)
		{
			$values->user_id = null;
		}
        $this->carsModel->updateCar($this->template->car, $values);
		
        $this->flashMessage('Vozidlo bolo úspešne editované!', 'success');
        $this->redirect('Car:');
    }
	
	public function carFormEdit(CarForm $form)
    {
        $values = $form->getValues();
		unset($values->car_id);
		
        $this->carsModel->updateCar($this->template->car, $values);
		
        $this->flashMessage('Vozidlo bolo úspešne editované!', 'success');
        $this->redirect('Car:');
    }
	
	/**
     * @param int $car_id
     */
    public function handleDelete($car_id)
    {
        $this->carsModel->deleteCar($car_id);
		
		$this->flashMessage('Vozidlo bolo úspešne vymazané!', 'success');
        $this->redirect('Car:');
    }
}

