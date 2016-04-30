<?php

namespace AdminModule\Datagrids;

use Models\CarsModel,
	Nette\Utils\Html;

class CarsGrid extends \Hyp\Application\UI\Controls\BaseGrid
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

	/**
	 * @param \Nette\Application\UI\Presenter $presenter
	 */
	protected function configure(\Nette\Application\UI\Presenter $presenter)
	{
		parent::configure($presenter);

		$this->setModel($this->carsModel->getAllCars());
		$this->setPrimaryKey($this->carsModel->getPrimaryKeyName());
		$this->setRememberState(TRUE);
		$this->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_INNER);

		$this->addColumnText('car_id', 'Evidenčné číslo')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('user_id', 'ID šoféra')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('fullname', 'Meno šoféra')
			->setSortable()
			->setFilterText();

		$this->addColumnText('weight', 'Maximálna váha')
			->setSortable()
			->setFilterText();
		
		$this->addColumnText('size', 'Maximálna veľkosť')
			->setSortable()
			->setFilterText();
		
		$this->addActionHref('edit', '')
            ->setIcon('pencil')
            ->getElementPrototype()->setTitle('Upraviť');
		
		$this->addActionHref('editDriver', '')
            ->setIcon('user')
            ->getElementPrototype()->setTitle('Upraviť sofera');

        $this->addActionHref('delete', '', 'delete!')
            ->setIcon('trash icon-white')
            ->setConfirm('Naozaj chcete odstrániť záznam?')
            ->setElementPrototype(
                Html::el('a')
                    ->addClass('btn btn-danger btn-mini')
                    ->setTitle('Zmazať'));
	}
}
