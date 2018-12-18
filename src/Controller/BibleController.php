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
use App\Entity\Bible;

class BibleController extends AbstractController
{
     /**
      * @Route("/")
      */
    public function index()
    {
        $bible = $this->getDoctrine()
           ->getRepository(Bible::class)
           ->find($id);        
        $word = "In the beginning God created the heaven and the earth.";
        $book = "Genesis";
        $chapter = "1";
        $verse = "1";
        $reference = "(" . $book . " " . $chapter . ":" . $verse . ")";
        return $this->render('word.html.twig', [
            'word' => $word,
            'reference' => $reference,
        ]);
    }
}

?>
