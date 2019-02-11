<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 17.10.2018
 * Time: 13:13
 */

namespace Src\Controllers;

use Src\Core\AbstractController;
use Src\Model\ModelCheck;
use Src\Model\ModelWords;

class ControllerTest extends AbstractController
{
    public function actionIndex()
    {
        $data = $this->getModel(new ModelWords());

        if($_POST["action"] == "check")
        {
            $data = array_merge($data, $this->getModel(new ModelCheck()));
            $this->view->generate('check.php', 'wrapper.php', $data);
        }
        elseif($data["page"] <= count($data["Words"]))
        {
            $this->view->generate('test.php', 'wrapper.php', $data);
        }
    }


}