<?php

/**
 * Created by PhpStorm.
 * User: 14400
 * Date: 12/18/2018
 * Time: 6:13 AM
 */

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class LuckyController
{
    public function number()
    {
        $number = "In the beginning God created the heaven and the earth. (Genesis 1:1)";

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}

?>