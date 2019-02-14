<?php

/**
 * Created by PhpStorm.
 * User: 14400
 * Date: 12/18/2018
 * Time: 6:13 AM
 */

// src/Controller/LuckyController.php
namespace App\Controller;
use Aws\S3\Exception\S3Exception;
use PhpParser\Error;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\UploadVideoType;
use Gaufrette\Adapter\AwsS3;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpKernel\Tests\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
use App\Entity\Videos;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Aws\Credentials\CredentialProvider;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception as S3;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
use Aws\S3\ObjectUploader;
use App\Service\MessageGenerator;
use Symfony\Component\Dotenv\Dotenv;

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
    /**
     * @Route("/video/upload", name="upload_video")
     */
    public function uploadVideo()
    {

        $request = Request::createFromGlobals();
////
//        $myEntity = new Videos();
//        $form = $this->createForm(UploadVideoType::class, $myEntity);
        $defaultData = ['description' => 'Type your message here'];
        $form = $this->createFormBuilder($defaultData)
            ->add('video', FileType::class)
            ->add('thumbnail', FileType::class)
            ->add('title', TextType::class)
            ->add('preacher', TextType::class)
            ->add('description', TextareaType::class)
            ->add('submit', SubmitType::class)

            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $bucket = getEnv('AWS_BUCKET_NAME');
            $key = getenv('AWS_KEY');
            $secret = getenv('AWS_SECRET_KEY');
            $credentials = new Credentials($key, $secret);
            $s3Client = new S3Client([
                'credentials' => $credentials,
                'region' => 'ap-southeast-2',
                'version' => '2006-03-01'
            ]);
//            $source = $request->files->get('brochure');

            $video_title = $form->get('title')->getData();
            $preacher = $form->get('preacher')->getData();
            $description = $form->get('description')->getData();

            $video_file_path = $form->get('video')->getData();
            $thumbnail_file_path = $form->get('thumbnail')->getData();
//            $uploader = new MultipartUploader($s3Client, $source, [
//                'bucket' => 'adventistsermonvideos',
//                'key' => 'my-file.jpg',
//            ]);
//
//            try {
//                $result = $uploader->upload();
//                echo "Upload complete: {$result['ObjectURL']}\n";
//            } catch (MultipartUploadException $e) {
//                echo $e->getMessage() . "\n";
//            }
            $key = $video_title . ".mp4";
            $source = fopen($video_file_path, 'rb');
            $uploader = new ObjectUploader(
                $s3Client,
                $bucket,
                $key,
                $source,
                'public-read',
                ['Metadata' => ['preacher'=> $preacher,
                    'description' => $description,
                    'ContentType' => 'video/mp4'],

            ]);


            do {
                try {
                    $thumbnail_result = $s3Client->putObject([
                        'Bucket' => "adventistsermonvideos",
                        'Key'    => $video_title.".jpg",
                        'SourceFile'   => $thumbnail_file_path,
                        'Metadata' => ['preacher'=> $preacher, 'description' => $description],
                        'ContentType' => 'image/jpg',
                        'ACL'    => 'public-read'
                    ]);

                    // Print the URL to the object.
                    echo $thumbnail_result['ObjectURL'] . PHP_EOL;

                    $result = $uploader->upload();
                    if ($result["@metadata"]["statusCode"] == '200') {
                        return new Response('<p>File successfully uploaded to ' . $result["ObjectURL"] . '.</p>');
                    }
                    print($result);
                    } catch (MultipartUploadException $e) {
                        rewind($video_file_path);
                        $uploader = new MultipartUploader($s3Client, $video_file_path, [
                            'state' => $e->getState(),
                        ]);

                    } catch (S3 $e) {
                        return new Response($e->getMessage() . PHP_EOL);
                    }
                    catch (Error $error){
                        return new Response ( $error->getMessage() . PHP_EOL);

                    }

            } while (!isset($result));

//
//            try {
//                // Upload data.
//                $video_result = $s3Client->putObject([
//                    'Bucket' => "adventistsermonvideos",
//                    'Key'    => $video_title.".mp4",
//                    'SourceFile'   => $video_file_path,
//                    'ContentType' => 'video/mp4',
//                    'Metadata' => ['preacher'=> $preacher, 'description' => $description],
//                    'ACL'    => 'public-read'
//                ]);
//
//                // Print the URL to the object.
//                echo $video_result['ObjectURL'] . PHP_EOL;
//            } catch (S3 $e) {
//                $file_error = new File();
//                $error_message = $file_error::TOO_LARGE_ERROR;
//                echo $e->getMessage() . PHP_EOL;
//            }
//
//            try {
//                // Upload data.
//                $thumbnail_result = $s3Client->putObject([
//                    'Bucket' => "adventistsermonvideos",
//                    'Key'    => $video_title.".jpg",
//                    'SourceFile'   => $thumbnail_file_path,
//                    'Metadata' => ['preacher'=> $preacher, 'description' => $description],
//                    'ContentType' => 'image/jpg',
//                    'ACL'    => 'public-read'
//                ]);
//
//                // Print the URL to the object.
//                echo $thumbnail_result['ObjectURL'] . PHP_EOL;
//            } catch (S3 $e) {
//                return new Response($e->getMessage() . PHP_EOL);
//            }
//            catch (Error $error){
//                return new Response ( $error->getMessage() . PHP_EOL);
//
//            }

            return new Response($video_title . " and " . $thumbnail_file_path . " successfully uploaded." );
        }
        //

//
//// Use multipart upload

        return $this->render('video/uploadVideo.html.twig', [
//            'videos' => $titles,
//            'username' => $user,
            'uploadVideoForm' => $form->createView()

        ]);

    }
}


