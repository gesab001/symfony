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

class BibleController extends AbstractController
{
//    /**
//     * @Route("/")
//     */
//    public function homepage()
//    {
//        return new Response('in the beginning God created the heaven and the earth');
//    }

    /**
     * @Route("/bible")
     */
    public function bible()
    {
        return new Response('in the beginning God created the heaven and the earth');
    }

function getCurrentID(){
   $totalVerses = 31102;
   date_default_timezone_set("Pacific/Auckland");
   $originalDate = strtotime("2018-06-23 14:45:00");
   $dateToday = date("Y-m-d H:i");
   $currentDate = strtotime("now");
   $difference_in_minutes = round(($currentDate-$originalDate)/60)+1;
   $id = $difference_in_minutes;
   while ($id>$totalVerses){
      $id = $id-$totalVerses;
   }
   return $id;
}

     /**
      * @Route("/", name="app_homepage")
      */

    public function index()
    {
        $id = $this->getCurrentID();
        $kjv = $this->getDoctrine()
        ->getRepository(Kjv::class)
        ->find($id);

        if (!$kjv) {
           throw $this->createNotFoundException(
              'No verse Found for id '.$id
        );
    }
        $word = $kjv->getWord();
        $book = $kjv->getBook();
        $chapter = $kjv->getChapter();
        $verse = $kjv->getVerse();
        $reference = "(" . $book . " " . $chapter . ":" . $verse . ")";
        return $this->render('bible/word.html.twig', [
            'word' => $word,
            'reference' => $reference,
        ]);
    }
}

?>
