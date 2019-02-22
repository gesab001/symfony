<?php

namespace App\Controller;

use App\Entity\Sabbath;
use App\Form\SabbathType;
use App\Repository\SabbathRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/sabbath")
 */
class SabbathController extends AbstractController
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

    /**
     * @Route("/", name="sabbath_index", methods={"GET"})
     */
    public function index(SabbathRepository $sabbathRepository): Response
    {
        return $this->render('sabbath/index.html.twig', [
            'sabbaths' => $sabbathRepository->findAll(),
        ]);
    }

    /**
     * @Route("/stories", name="sabbath_stories")
     */
//    public function getTitles()
//    {
    public function getSabbathStories(Request $request, PaginatorInterface $paginator)
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
        $sabbathRepository = $em->getRepository(Sabbath::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allSabbathQuery = $sabbathRepository->createQueryBuilder('id')
            ->orderBy('id.id', 'DESC')

//            ->where('p.status != :status')
//            ->setParameter('status', 'canceled')
            ->getQuery();

        /* @var $paginator \Knp\Component\Pager\Paginator */
//        $paginator = $this->get('knp_paginator');

        // Paginate the results of the query
        $titles = $paginator->paginate(
        // Doctrine Query, not results
            $allSabbathQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            100
        );

        $user = $this->getUserProfile();

        // Render the twig view
        return $this->render('sabbath/sabbath.html.twig', [
            'sabbathStories' => $titles,
            'username' => $user

        ]);
    }


    /**
     * @Route("/new", name="sabbath_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sabbath = new Sabbath();
        $form = $this->createForm(SabbathType::class, $sabbath);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sabbath);
            $entityManager->flush();

            return $this->redirectToRoute('sabbath_index');
        }

        return $this->render('sabbath/new.html.twig', [
            'sabbath' => $sabbath,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sabbath_show", methods={"GET"})
     */
    public function show(Sabbath $sabbath): Response
    {
        return $this->render('sabbath/show.html.twig', [
            'sabbath' => $sabbath,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sabbath_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sabbath $sabbath): Response
    {
        $form = $this->createForm(SabbathType::class, $sabbath);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sabbath_index', [
                'id' => $sabbath->getId(),
            ]);
        }

        return $this->render('sabbath/edit.html.twig', [
            'sabbath' => $sabbath,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sabbath_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sabbath $sabbath): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sabbath->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sabbath);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sabbath_index');
    }
}
