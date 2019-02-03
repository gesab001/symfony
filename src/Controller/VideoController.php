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
use App\Entity\Videos;


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
        $video = $this->getDoctrine()
            ->getRepository(Videos::class)
            ->find($id);

        if (!$video) {
            throw $this->createNotFoundException(
                'No video found for id ' . $id
            );
        }

        return $this->render('video/videoShow.html.twig', [
            'video'=> $video]);


        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/video", name="app_video")
     */
    public function getTitles()
    {
        $videos = $this->getDoctrine()->getRepository(Videos::class)->findAll();
        if (!$videos) {
            throw $this->createNotFoundException(
                'No titles found'
            );
        }

        return $this->render('video/video.html.twig',
            array('videos' => $videos)
        );
    }

}


