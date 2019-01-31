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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Kjv;

class VideoController extends AbstractController
{
//    /**
//     * @Route("/")
//     */
//    public function homepage()
//    {
//        return new Response('in the beginning God created the heaven and the earth');
//    }

    /**
     * @Route("/video", name="app_video")
     */
    public function showVideo(){
        $titles = ["amazing grace", "redeemed", "coming again"];

        return $this->render('video/video.html.twig', [
            'titles'=> $titles]);
    }

}

?>
