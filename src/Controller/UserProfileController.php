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

class UserProfileController extends Controller
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
      * @Route("/userprofile", name="user_profile")
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
        return $this->render('user/userprofile.html.twig', [
            'word' => $word,
            'book' => $book,
            'chapter' => $chapter,
            'verse' => $verse,
            'username' => $user

        ]);
    }
}

?>
