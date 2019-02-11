<?php

namespace Src\Core;

abstract class AbstractController {
	
	public $model;
	public $view;
	
	function __construct()
	{
		$this->view = new View();
	}

    protected function getModel(AbstractModel $model)
    {
        return $model->getData();
    }

    public abstract function actionIndex();
}
