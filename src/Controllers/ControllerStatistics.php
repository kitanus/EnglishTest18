<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 22.10.2018
 * Time: 17:01
 */

namespace Src\Controllers;

use Src\Core\AbstractController;
use Src\Model\ModelStatistics;

class ControllerStatistics extends AbstractController
{
    function actionIndex()
    {
        $data = $this->getModel(new ModelStatistics());
        $this->view->generate('statistics.php', 'wrapper.php', $data);
    }
}