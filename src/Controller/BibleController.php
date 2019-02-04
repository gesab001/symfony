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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//use Symfony\Component\HttpKernel\Tests\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Kjv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Controller\UserController;

class BibleController extends Controller
{

//    /**
//     * @Route("/")
//     */
//    public function homepage()
//    {
//        return new Response('in the beginning God created the heaven and the earth');
//    }
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
                'No verse Found for id ' . $id
            );
        }

//        $userprofile = new UserController();
        $user = $this->getUserProfile();
        $word = $kjv->getWord();
        $book = $kjv->getBook();
        $chapter = $kjv->getChapter();
        $verse = $kjv->getVerse();
        //$reference = "(" . $book . " " . $chapter . ":" . $verse . ")";
        return $this->render('bible/word.html.twig', [
            'word' => $word,
            'book' => $book,
            'chapter' => $chapter,
            'verse' => $verse,
            'username' => $user

        ]);
    }

    /**
     * @Route("/kjv/search_kjv", name="search_kjv")
     */
    public function searchBible(Request $request)
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
        $keyword = $request->get("keyword");
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $hymnsRepository = $em->getRepository(Kjv::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allHymnsQuery = $hymnsRepository->createQueryBuilder('w')
            ->where('w.word LIKE :word')
            ->setParameter('word', '%'.$keyword.'%')
            ->getQuery();


        /* @var $paginator \Knp\Component\Pager\Paginator */
        $paginator  = $this->get('knp_paginator');
        $user = $this->getUser()->getUsername();

        // Paginate the results of the query
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $allHymnsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            100
        );

//        $totalResults = $results->count();

        $user = $this->getUserProfile();

        // Render the twig view
        return $this->render('bible/searchResultsKjv.html.twig', [
            'results' => $results,
            'username' => $user
//          'total' => $totalResults
        ]);
    }

    /**
     * @Route("/kjv/{book}/{chapter}", name="read_chapter")
     */
    public function readChapter(Request $request, $book, $chapter)
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
//        $book = $request->get("book");
//        $chapter = $request->get("chapter");
        dump($book, $chapter, $this);
        $user = $this->getUser()->getUsername();

        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager();

        // Get some repository of data, in our case we have an Appointments entity
        $hymnsRepository = $em->getRepository(Kjv::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allHymnsQuery = $hymnsRepository->createQueryBuilder('c')
            ->where('c.chapter = :chapter')
            ->andWhere('c.book = :book')
            ->setParameter('chapter', $chapter)
            ->setParameter('book', $book)
            ->getQuery();

        /* @var $paginator \Knp\Component\Pager\Paginator */
        $paginator  = $this->get('knp_paginator');

        // Paginate the results of the query
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $allHymnsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            100
        );

        $user = $this->getUserProfile();

        // Render the twig view
        return $this->render('bible/chapterReadingKjv.html.twig', [
            'results' => $results,
            'username' => $user
        ]);
    }
}

?>
