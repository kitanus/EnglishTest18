<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 20.10.2018
 * Time: 12:56
 */

namespace Src\Model;

use Src\Core\AbstractModel;

class ModelStatistics extends AbstractModel
{
    public function getData()
    {
        $words = $this->db
            ->setSelect("words", ["word", "translation", "value", "all_time", "good_count", "percent"])
            ->setLeftJoin("state", "words", true)
            ->setSort("words.id", "ASC")
            ->setQuery();

        $color = [];
        foreach($words as $key => $value)
        {
            if($value["percent"] > 80)
            {
                $state = 1;
                $color[$key] = "#03ff03";
            }
            elseif($value["percent"] > 60)
            {
                $state = 2;
                $color[$key] = "#89ca01";
            }
            elseif($value["percent"] > 40)
            {
                $state = 3;
                $color[$key] = "#caca01";
            }
            elseif($value["percent"] > 20)
            {
                $state = 4;
                $color[$key] = "#ff5d04";
            }
            else
            {
                $state = 5;
                $color[$key] = "#ff0404";
            }

            $this->db
                ->setUpdate("words", ["state_id" => $state])
                ->setWhere("word='{$value["word"]}'")
                ->setQuery();
        }

        $test["test"] = $_GET["test"] ? "end" : "noStart";

        $words = $this->db
            ->setSelect("words", ["word", "translation", "value", "all_time", "good_count", "percent"])
            ->setLeftJoin("state", "words", true)
            ->setSort("words.id", "ASC")
            ->setQuery();

        $this->arrayMerge([
            ["wordList" => $words],
            $test,
            ["colors" => $color]
        ]);

        return $this->data;
    }

}