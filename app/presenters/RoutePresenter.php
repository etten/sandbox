<?php

namespace App\Presenters;

use App\Models\Routes\Route;
use Nette\Application\BadRequestException;

abstract class RoutePresenter extends BasePresenter
{

	/**
	 * @var Route
	 * @persistent
	 */
	public $route;

	protected function startup()
	{
		parent::startup();

		if (!($this->route && $this->route instanceof Route)) {
			throw new BadRequestException('Cannot load ' . __CLASS__ . ' without Route parameter.');
		}
	}

	protected function beforeRender()
	{
		parent::beforeRender();
		$this->template->route = $this->route;
	}

}
