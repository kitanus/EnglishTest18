<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 22.10.2018
 * Time: 20:52
 */

namespace Src\Controllers;

use Src\Model\ModelSetting;
use Src\Core\AbstractController;

class ControllerSetting extends AbstractController
{
    function actionIndex()
    {
        $data = $this->getModel(new ModelSetting());
        $this->view->generate('setting.php', 'wrapper.php', $data);
    }
}