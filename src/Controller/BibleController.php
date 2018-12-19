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
use App\Entity\Genesis;
use App\Entity\Books;

class BibleController extends AbstractController
{

function getCurrentID(){
   $totalVerses = $this->setTotalVerses();
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

function setTotalVerses(){
        $id = 1;
        $total = $this->getDoctrine()
        ->getRepository(Books::class)
        ->find($id);

        if (!$total) {
           throw $this->createNotFoundException(
              'No book found for id '.$id
        );
    }
        $totalVerses = $total->getVerses();
        return $totalVerses;
}
     /**
      * @Route("/")
      */

    public function index()
    {
        $id = $this->getCurrentID();
        $genesis = $this->getDoctrine()
        ->getRepository(Genesis::class)
        ->find($id);

        if (!$genesis) {
           throw $this->createNotFoundException(
              'No verse found for id '.$id
        );
    }
        $word = $genesis->getWord();
        $book = $genesis->getBook();
        $chapter = $genesis->getChapter();
        $verse = $genesis->getVerse();
        $reference = "(" . $book . " " . $chapter . ":" . $verse . ")";
        return $this->render('word.html.twig', [
            'word' => $word,
            'reference' => $reference,
        ]);
    }
}

?>
