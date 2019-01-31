<?php

/**
 * Created by PhpStorm.
 * User: 14400
 * Date: 12/18/2018
 * Time: 6:13 AM
 */

// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Hymns;
use PhpParser\Node\Expr\Array_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Kjv;
use Symfony\Component\HttpFoundation\Request;

class HymnController extends AbstractController
{
//    /**
//     * @Route("/")
//     */
//    public function homepage()
//    {
//        return new Response('in the beginning God created the heaven and the earth');
//    }

    /**
     * @Route("/hymn", name="app_hymn")
     */
    public function getTitles()
    {
        $titles = $this->getDoctrine()->getRepository(Hymns::class)->findAll();
        if (!$titles) {
            throw $this->createNotFoundException(
                'No titles found'
            );
        }

        return $this->render('hymn/hymn.html.twig',
            array('hymns' => $titles)
        );
    }


//    /**
//     * @Route("/hymn/aHymn", name="app_aHymn")
//     */
//    public function showHymn()
//    {
//        $number = 200 + 1;
//        $aHymn = $this->getDoctrine()->getRepository(Hymns::class)
//            ->find($number);
//
//        if (!$aHymn) {
//            throw $this->createNotFoundException(
//                'No verse Found for id ' . $number
//            );
//        }
//        $hymnNumber = $aHymn->getNumber();
//        $title = $aHymn->getTitle();
//        $verses = $aHymn->getVerses();
//
//        return $this->render('hymn/showHymn.html.twig', [
//            'number' => $hymnNumber,
//            'title' => $title,
//            'verses' => $verses
//        ]);
//    }

    public function splitVerses($words){
        $versesList = [];
        $verses = explode("Verse", $words);
        foreach ($verses as $value){
            if (strpos($value, 'Refrain') == true) {
                $verserefrain = explode("Refrain", $value);
                $line1 = "Verse"  . $verserefrain[0];
                array_push($versesList, $line1);

                $line2 = "Refrain";
                array_push($versesList, $line2);

                $line3 = $verserefrain[1];
                array_push($versesList, $line3);


            }
            else{
                $line4 = "Verse" . $value;
                array_push($versesList, $line4);
            }
        }
        return $versesList;
    }
    /**
     * @Route("/hymn/number/{number}/title/{title}", name="open_a_hymn", methods={"GET"})
     */
    public function openHymn(Request $request, $number)
    {

        dump($number, $this);
        // TODO - actually heart/unheart the article!
        $aHymn = $this->getDoctrine()->getRepository(Hymns::class)
            ->find($number);

        if (!$aHymn) {
            throw $this->createNotFoundException(
                'No verse Found for id ' . $number
            );
        }
        $hymnNumber = $aHymn->getNumber();
        $title = $aHymn->getTitle();
//        $versesRaw = $aHymn->getVerses();
//        $verses = $this->splitVerses($versesRaw);
        $verses = $aHymn->getVerses();
       // unset($verses[0]);
        return $this->render('hymn/showHymn.html.twig', [
            'number' => $hymnNumber,
            'title' => $title,
            'verses' => $verses
        ]);
      //  return new JsonResponse(['hearts' => rand(5, 100)]);
    }
}
?>
