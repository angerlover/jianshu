<?php
/**
 * Created by PhpStorm.
 * User: pepe
 * Date: 2017/10/19
 * Time: 下午6:19
 */

namespace App\ServiceTest;


class InstanceService implements ServiceContract
{
    function say()
    {
        echo '操你爸';
    }
}