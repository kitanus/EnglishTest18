<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 17.10.2018
 * Time: 13:02
 */

namespace Src\Model;

use Src\Core\AbstractModel;
use Src\Traits\RandomArray;

class ModelWords extends AbstractModel
{
    use RandomArray;

    private $order;

    public function getData()
    {
        $this->initialize();

        if($_POST["action"] != "check")
        {
            $this->saveOrder();
        }

        $this->arrayMerge([
            $this->final,
            $this->page,
            $this->order
        ]);

        return $this->data;
    }

    private function initialize()
    {
        $count = $this->db
            ->setSelect("setting")
            ->setWhere("name='count'")
            ->setQuery();

        $order = ["order" => $this->getRandArray($this->page["page"]-1, $count[0]["value"], count($this->final["Words"]))];
        foreach ($order["order"] as $key => $value)
        {
            $this->order["order"][$key] = $this->final["Words"][$value]["translation"];
        }
    }

    private function saveOrder()
    {
        $this->db->setTruncate("store")->setQuery();
        $insertArray = [];

        foreach ($this->order["order"] as $key => $value)
        {
              $insertArray[] = [NULL, $value];
        }

        $this->db
            ->setInsert("store", ["id", "translation"], $insertArray)
            ->setQuery();
    }
}