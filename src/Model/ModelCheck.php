<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 20.10.2018
 * Time: 12:26
 */

namespace Src\Model;

use Src\Core\AbstractModel;

class ModelCheck extends AbstractModel
{

    public function getData()
    {
        $this->arrayMerge([
            $this->getCheckOrder(),
            $this->getAnswer()
        ]);

        return $this->data;
    }

    private function getCheckOrder()
    {
        $finalWords = [];
        $trueTranslate = $this->final["Words"][$this->page["page"]-1]["translation"];

        $order = $this->db
            ->setSelect("store", ["translation"])
            ->setQuery();

        foreach ($order as $key => $value)
        {
            switch ($value["translation"])
            {
                case $_POST["trans"]:
                    $finalWords[] = ($value["translation"] == $trueTranslate)
                        ? ["goodAnswer", $value["translation"]]
                        : ["badAnswer", $value["translation"]];
                    break;
                case $trueTranslate:
                    $finalWords[] = ["goodAnswer", $value["translation"]];
                    break;
                default:
                    $finalWords[] = ["noAnswer", $value["translation"]];
            }
        }

        return ["finalOrder" => $finalWords];
    }

    private function getAnswer()
    {
        $finalAnswer = ["answer" => ["Bad", "Вы ответили неправильно.", ""]];
        $trueTranslate = $this->final["Words"][$this->page["page"]-1]["translation"];
        $trueAllTime = $this->final["Words"][$this->page["page"]-1]["all_time"];

        $order = $this->db
            ->setSelect("store", ["translation"])
            ->setQuery();

        foreach ($order as $key => $value)
        {
            if($value["translation"] == $trueTranslate && $value["translation"] == $_POST["trans"])
            {
                $arrayChange = $this->getInsertCount($value["translation"]);
                $finalAnswer = ["answer" => ["Good", "Вы ответили правильно.", $arrayChange["percent"]."%."]];
                $this->updateWord($arrayChange, $value["translation"]);
                $arrayChange = [];
            }
            elseif($value["translation"] == $_POST["trans"])
            {
                $trueInfo = $this->db
                    ->setSelect("words", ["all_time"])
                    ->setWhere("translation='{$value["translation"]}'")
                    ->setQuery();

                $this->updateWord(["all_time" => $trueInfo[0]["all_time"]+1], $value["translation"]);
            }
        }
        $this->updateWord(["all_time" => $trueAllTime+1], $trueTranslate);

        return $finalAnswer;
    }

    private function getInsertCount($translation)
    {
        $trueInfo = $this->db
            ->setSelect("words", ["id", "all_time", "good_count"])
            ->setWhere("translation='{$translation}'")
            ->setQuery();

        $percent = round((($trueInfo[0]["good_count"]+1)/($trueInfo[0]["all_time"]+1))*100);

        return [
            "good_count" => $trueInfo[0]["good_count"]+1,
            "all_time" => $trueInfo[0]["all_time"]+1,
            "percent" => $percent
        ];
    }

    private function updateWord($arrayChange, $translation)
    {
        $this->db
            ->setUpdate("words",$arrayChange)
            ->setWhere("translation='{$translation}'")
            ->setQuery();
    }
}