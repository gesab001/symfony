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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpKernel\Tests\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Kjv;
use App\Entity\Videos;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;


class VideoController extends Controller
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
     * @Route("/video/add/title/{title}/preacher/{preacher}/description/{description}/filename/{filename}/thumbnail/{thumbnail}", name="add_videos")
     */
    public function addVideos($title, $preacher, $description, $filename, $thumbnail)
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $url = "https://s3-ap-southeast-2.amazonaws.com/adventistsermonvideos/";
        $video = new Videos();
        $video->setTitle($title);
        $video->setUrl($url);
        $video->setPreacher($preacher);
        $video->setDescription($description);
        $video->setFilename( $filename);
        $video->setThumbnail($thumbnail);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($video);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new video with id '.$video->getId());
    }
//
//    /**
//     * @Route("/video", name="app_video")
//     */
//    public function showVideo(){
//        $titles = ["amazing grace", "redeemed", "coming again"];
//
//        return $this->render('video/video.html.twig', [
//            'titles'=> $titles]);
//    }


    /**
     * @Route("/video/{id}/{title}/{preacher}", name="show_video", methods={"GET"})
     */
    public function show($id, $title, $preacher)
    {
        $user = $this->getUserProfile();

        $video = $this->getDoctrine()
            ->getRepository(Videos::class)
            ->find($id);

        if (!$video) {
            throw $this->createNotFoundException(
                'No video found for id ' . $id
            );
        }

        return $this->render('video/videoShow.html.twig', [
            'video'=> $video,
            'username'=> $user
        ]);


        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/video", name="app_video")
     */
//    public function getTitles()
//    {
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
            $hymnsRepository = $em->getRepository(Videos::class);

            // Find all the data on the Appointments table, filter your query as you need
            $allHymnsQuery = $hymnsRepository->createQueryBuilder('id')
                ->orderBy('id.id', 'DESC')

//            ->where('p.status != :status')
//            ->setParameter('status', 'canceled')
                ->getQuery();

            /* @var $paginator \Knp\Component\Pager\Paginator */
            $paginator = $this->get('knp_paginator');

            // Paginate the results of the query
            $titles = $paginator->paginate(
            // Doctrine Query, not results
                $allHymnsQuery,
                // Define the page parameter
                $request->query->getInt('page', 1),
                // Items per page
                100
            );

            $user = $this->getUserProfile();

            // Render the twig view
            return $this->render('video/video.html.twig', [
                'videos' => $titles,
                'username' => $user

            ]);
        }
//    }
//        $videos = $this->getDoctrine()->getRepository(Videos::class)->findAll();
//        if (!$videos) {
//            throw $this->createNotFoundException(
//                'No titles found'
//            );
//        }
//
//        return $this->render('video/video.html.twig',
//            array('videos' => $videos)
//        );
//    }

}


