<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 22.10.2018
 * Time: 20:53
 */

namespace Src\Model;

use Src\Core\AbstractModel;

class ModelSetting extends AbstractModel
{
    public function getData()
    {
        if(!empty($_POST["word"]))
        {
            $this->InsertNewWord();
        }

        $allWords = $this->getWords();

        $this->arrayMerge([
            ["list" => $allWords],
            ["count" => $this->getCountWord()],
            ["check" => $this->getCheck($allWords)]
        ]);

        return $this->data;
    }

    private function getWords()
    {
        $allWords = $this->db
            ->setSelect("words", ["word", "useWord"])
            ->setQuery();

        if($_POST["notUsed"])
        {
            foreach($allWords as $key => $value)
            {
                $this->db
                    ->setUpdate("words", ["useWord" => "1"])
                    ->setWhere("word='{$value["word"]}'")
                    ->setQuery();
            }

            foreach($_POST["notUsed"] as $key => $value)
            {
                $this->db
                    ->setUpdate("words", ["useWord" => "0"])
                    ->setWhere("word='{$_POST["notUsed"][$key]}'")
                    ->setQuery();
            }
        }

        return $this->db
            ->setSelect("words", ["word", "useWord"])
            ->setQuery();
    }

    private function getCheck($allWords)
    {
        $check = [];

        foreach ($allWords as $key => $value)
        {
            $check[$key] = ($value["useWord"] == "1") ? "" : "checked";
        }

        return $check;
    }

    private function getCountWord()
    {
        $selectCount = $this->db
            ->setSelect("options")
            ->setQuery();

        $this->db
            ->setUpdate("setting", ["value" => $_POST["count"]])
            ->setWhere("name='count'")
            ->setQuery();

        $count = $this->db
            ->setSelect("setting")
            ->setWhere("name='count'")
            ->setQuery();

        foreach($selectCount as $key => $value)
        {
            $selectCount[$key]["selected"] = ($count[0]["value"] == $value["value"]) ? "selected" : "";
        }

        return $selectCount;
    }

    private function InsertNewWord()
    {
        $insertArray = [];
        foreach ($_POST["word"] as $key => $value)
        {
            $insertArray[] = [NULL, $_POST["word"][$key], $_POST["translation"][$key], 0, 0, 3, 0];
        }

        $this->db
            ->setInsert("words", [
                "id",
                "word",
                "translation",
                "all_time",
                "good_count",
                "state_id",
                "percent"
            ], $insertArray)
            ->setQuery();
    }

}