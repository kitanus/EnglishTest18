<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 17.10.2018
 * Time: 11:41
 */

namespace Src\Core;


class View
{
    function generate($content_view, $template_view, $data = null)
    {
        require __DIR__."/../View/".$template_view;
    }
}