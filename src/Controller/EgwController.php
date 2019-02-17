<?php

/**
 * Created by PhpStorm.
 * User: 14400
 * Date: 12/18/2018
 * Time: 6:13 AM
 */

// src/Controller/LuckyController.php
namespace App\Controller;

use App\Controller\Egw\DaController;
use App\Entity\Egw\Da;
use App\Entity\Egw\EgwWritingsComplete;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//use Symfony\Component\HttpKernel\Tests\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Kjv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Controller\UserController;
use App\Controller\EGWBooksController;


class EgwController extends Controller
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
     * @Route("/today")
     */
    public function egwToday()
    {
        $da = new DaController();
        $daBook = $da->showTodayParagraph();
        return $this->render('today/today.html.twig', ['daBook' => $daBook]);
    }

function getCurrentID(){
   $totalVerses = 2590;
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
     * @Route("/today", name="today_show")
     *
     */
    public function showToday(Request $request)
    {
        $id = $this->getCurrentID();
        $da = $this->getDoctrine()
            ->getRepository(Da::class, 'egw')
            ->find($id);

        if (!$da) {
            throw $this->createNotFoundException(
                'No verse Found for id ' . $id
            );
        }

//        $userprofile = new UserController();
//        $user = $this->getUserProfile();
//        $word = $kjv->getWord();
//        $book = $kjv->getBook();
//        $chapter = $kjv->getChapter();
//        $verse = $kjv->getVerse();
        //$reference = "(" . $book . " " . $chapter . ":" . $verse . ")";
        $da = $this->showTodayParagraph();
        return $this->render('today/today.html.twig', [
            'da' => $da,


        ]);
//        return $this->render('to.html.twig', [
//            'da' => $da,
//        ]);
    }


    public function showTodayParagraph()
    {
        $id = $this->getCurrentID();
        $da = $this->getDoctrine()
            ->getRepository(Da::class, 'egw')
            ->find($id);

        if (!$da) {
            throw $this->createNotFoundException(
                'No verse Found for id ' . $id
            );
        }

//        $userprofile = new UserController();
//        $user = $this->getUserProfile();
//        $word = $kjv->getWord();
//        $book = $kjv->getBook();
//        $chapter = $kjv->getChapter();
//        $verse = $kjv->getVerse();
        //$reference = "(" . $book . " " . $chapter . ":" . $verse . ")";
        return $da;
//        return $this->render('egw/da/show.html.twig', [
//            'da' => $da,
//        ]);
    }

    /**
     * @Route("/egw/search/{keyword}", name="egw_search_url")
     */
    public function searchEgw_url(Request $request, $keyword)
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
//        $keyword = $request->get("keyword");
        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager('egw');

        // Get some repository of data, in our case we have an Appointments entity
        $hymnsRepository = $em->getRepository(EgwWritingsComplete::class, 'egw');

        // Find all the data on the Appointments table, filter your query as you need
        $allHymnsQuery = $hymnsRepository->createQueryBuilder('w')
            ->where('w.word LIKE :word')
            ->setParameter('word', '%'.$keyword.'%')
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

//        $totalResults = $results->count();

        $user = $this->getUserProfile();

        // Render the twig view
        return $this->render('egw/searchResultsEgw.html.twig', [
            'results' => $results,
            'username' => $user
//          'total' => $totalResults
        ]);
    }

    /**
     * @Route("/egw/{book}/{page}", name="egw_read_chapter")
     */
    public function egw_readChapter(Request $request, $book, $page)
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
//        $page = $request->get("page");

//        $chapter = $request->get("chapter");
//        dump($book, $chapter, $this);

        // Retrieve the entity manager of Doctrine
        $em = $this->getDoctrine()->getManager('egw');

        // Get some repository of data, in our case we have an Appointments entity
        $hymnsRepository = $em->getRepository(EgwWritingsComplete::class, 'egw');

        // Find all the data on the Appointments table, filter your query as you need
        $allHymnsQuery = $hymnsRepository->createQueryBuilder('c')
            ->where('c.bookcode LIKE :bookcode')
            ->andWhere('c.page = :page')
            ->setParameter('bookcode', $book)
            ->setParameter('page', $page)
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
        return $this->render('egw/chapterReadingEgw.html.twig', [
            'results' => $results,
            'username' => $user
        ]);
    }
//
//    /**
//     * @Route("/egw/{book}", name="egw_read_chapter")
//     */
//    public function egw_readBook(Request $request, $book)
//    {
////        $titles = $this->getDoctrine()->getRepository(Hymns::class)->findAll();
////        if (!$titles) {
////            throw $this->createNotFoundException(
////                'No titles found'
////            );
////        }
////
////
////        return $this->render('hymn/hymn.html.twig',
////            array('hymns' => $titles)
////        );
//        $book = $request->get("book");
////        $chapter = $request->get("chapter");
////        dump($book, $chapter, $this);
//
//        // Retrieve the entity manager of Doctrine
//        $em = $this->getDoctrine()->getManager('egw');
//
//        // Get some repository of data, in our case we have an Appointments entity
//        $hymnsRepository = $em->getRepository(EgwWritingsComplete::class, 'egw');
//
//        // Find all the data on the Appointments table, filter your query as you need
//        $allHymnsQuery = $hymnsRepository->createQueryBuilder('c')
//            ->where('c.bookcode = :bookcode')
//            ->setParameter('bookcode', $book)
//            ->getQuery();
//
//        /* @var $paginator \Knp\Component\Pager\Paginator */
//        $paginator  = $this->get('knp_paginator');
//
//        // Paginate the results of the query
//        $results = $paginator->paginate(
//        // Doctrine Query, not results
//            $allHymnsQuery,
//            // Define the page parameter
//            $request->query->getInt('page', 1),
//            // Items per page
//            100
//        );
//
//        $user = $this->getUserProfile();
//
//        // Render the twig view
//        return $this->render('egw/chapterReadingEgw.html.twig', [
//            'results' => $results,
//            'username' => $user
//        ]);
//    }
}

?>
