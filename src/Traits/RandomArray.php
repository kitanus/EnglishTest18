<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 26.09.2018
 * Time: 8:36
 */

namespace Src\Traits;

trait RandomArray
{
    public function getRandArray($mainNumber, $count, $max)
    {
        $randArr = [];
        $finalArr = [];

        $randWord = rand(0,$count-1);

        for($i=0; $i<$max; $i++)
        {
            if($mainNumber == $i)
            {
                $i++;
            }

            $randArr[] = $i;
        }

        array_pop($randArr);
        shuffle($randArr);

        for($i=0; $i<$count; $i++)
        {
            if($randWord == $i){
                $finalArr[] = $mainNumber;
            }else{
                $finalArr[] = $randArr[$i];
            }
        }

        return $finalArr;
    }
}