<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 17.10.2018
 * Time: 11:50
 */

namespace Src\Core;

use Src\Controllers\ControllerStatistics;
use Src\Controllers\ControllerTest;
use Src\Controllers\ControllerStart;
use Src\Controllers\ControllerSetting;

class ControllerFactory
{
    public function getController(AbstractController $abstractController)
    {
        return $abstractController;
    }

    public function getStart()
    {
        return $this->getController(new ControllerStart());
    }

    public function getTest()
    {
        return $this->getController(new ControllerTest());
    }

    public function getStatistics()
    {
        return $this->getController(new ControllerStatistics());
    }

    public function getSetting()
    {
        return $this->getController(new ControllerSetting());
    }
}