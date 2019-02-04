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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Kjv;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Security;


class HymnController extends Controller
{

    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }

    public function getUserProfile()
    {
        // returns User object or null if not authenticated
        $user = $this->security->getUser();
        return $user;
    }
//    /**
//     * @Route("/")
//     */
//    public function homepage()
//    {
//        return new Response('in the beginning God created the heaven and the earth');
//    }
    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug)
    {
        $comments = ["this is good", "i don't like this one", "are you serious"];

        dump($slug,$this);
        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("/hymn", name="app_hymn")
     */
    public function getTitles(Request $request)
    {
//        $titles = $this->getDoctrine()->getRepository(Hymns::class)->findAll();
//        if (!$titles) {
//            throw $this->createNotFoundException(
//                'No titles found'
//            );
//        }
//
//
//        return $this->render('hymn/hymn.html.twig',
//            array('hymns' => $titles)
//        );

        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $hymnsRepository = $em->getRepository(Hymns::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allHymnsQuery = $hymnsRepository->createQueryBuilder('id')
//            ->where('p.status != :status')
//            ->setParameter('status', 'canceled')
            ->getQuery();

        /* @var $paginator \Knp\Component\Pager\Paginator */
        $paginator  = $this->get('knp_paginator');
        $user = $this->getUserProfile();

        // Paginate the results of the query
        $titles = $paginator->paginate(
        // Doctrine Query, not results
            $allHymnsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            100
        );


        // Render the twig view
        return $this->render('hymn/hymn.html.twig', [
            'hymns' => $titles,
            'username' => $user

        ]);
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
        $user = $this->getUserProfile();

        $hymnNumber = $aHymn->getNumber();
        $title = $aHymn->getTitle();
//        $versesRaw = $aHymn->getVerses();
//        $verses = $this->splitVerses($versesRaw);
        $verses = $aHymn->getVerses();
       // unset($verses[0]);
        return $this->render('hymn/showHymn.html.twig', [
            'number' => $hymnNumber,
            'title' => $title,
            'verses' => $verses,
            'username' => $user
        ]);
      //  return new JsonResponse(['hearts' => rand(5, 100)]);
    }

       /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */

    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {

        // TODO - actually heart/unheart the article!
        $logger->info('Article is being hearted');

        return new JsonResponse(['hearts' => rand(5, 100)]);
    }

}
?>
