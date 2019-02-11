<?php

namespace Src\Core;

use Src\Database\MySQL;

abstract class AbstractModel
{
    /**
     * @var MySQL
     */
    protected $db;

    protected $data = [];
    protected $page;
    protected $final;

    public function __construct()
    {
        $this->db = new MySQL();
        $this->page = ["page" => $_GET["page"]];
        $words = $this->db->setSelect("words")->setWhere("useWord='1'");
        $this->final = $this->getListWords($words->setQuery());
    }

    protected function arrayMerge($arr = [])
    {
        foreach ($arr as $key => $value)
        {
            if(isset($value))
            {
                $this->data = array_merge($this->data, $value);
            }
        }
    }

    protected function getListWords($words)
    {
        $arrFinal = [];
        foreach($words as $key => $value)
        {
            $arr = [];
            foreach ($value as $key2 => $value2)
            {
                $arr[$key2] =  $value2;
            }
            $arrFinal[] = $arr;
        }

        return ["Words" => $arrFinal];
    }

    public abstract function getData();
}