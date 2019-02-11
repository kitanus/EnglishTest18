<?php

namespace Src\Controllers;

use Src\Core\AbstractController;
use Src\Model\ModelSql;

class ControllerStart extends AbstractController
{
	function actionIndex()
	{
        $data = $this->getModel(new ModelSql());
		$this->view->generate('start.php', 'wrapper.php', $data);
	}
}