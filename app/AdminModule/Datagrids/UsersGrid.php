<?php

namespace AdminModule\Datagrids;

use Models\UsersModel,
	Nette\Utils\Html;

class UsersGrid extends \FRI\Application\UI\Controls\BaseGrid
{
	/**
	 * @var UsersModel
	 */
	private $usersModel;


	/**
	 * @param UsersModel $usersModel
	 */
	public function __construct(UsersModel $usersModel)
	{
		parent::__construct();

		$this->usersModel = $usersModel;
	}

	/**
	 * @param \Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);

		$this->setModel($this->usersModel->getAllUsers());
		$this->setPrimaryKey($this->usersModel->getPrimaryKeyName());
		$this->setRememberState(TRUE);
		$this->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_INNER);

		$this->addColumnText('user_id', 'Id užívateľa')
			->setSortable();
		
		$this->addColumnText('name', 'Meno')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('surname', 'Priezvisko')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('personal_id', 'Rodné číslo')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('email', 'Email')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('address', 'Adresa')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('employed_from', 'Zamestnaný od')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('employed_to', 'Zamestnaný do')
			->setSortable()
			->setFilterText();
	}
}
