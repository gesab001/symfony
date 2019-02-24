<?php

namespace App\Controller;

use App\Entity\Flowers;
use App\Form\FlowersType;
use App\Repository\FlowersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\UserProfile;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/flowers")
 */
class FlowersController extends AbstractController
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
     * @Route("/", name="flowers_index", methods={"GET"})
     */
    public function index(FlowersRepository $flowersRepository): Response
    {
        return $this->render('flowers/index.html.twig', [
            'flowers' => $flowersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="flowers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $flower = new Flowers();
        $form = $this->createForm(FlowersType::class, $flower);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($flower);
            $entityManager->flush();

            return $this->redirectToRoute('flowers_index');
        }

        return $this->render('flowers/new.html.twig', [
            'flower' => $flower,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="flowers_show", methods={"GET"})
     */
    public function show(Flowers $flower): Response
    {
        $user = $this->getUserProfile();
        return $this->render('flowers/show.html.twig', [
            'flower' => $flower,
            'user' => $user
        ]);
    }

    /**
     * @Route("/{id}/edit", name="flowers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Flowers $flower): Response
    {
        $form = $this->createForm(FlowersType::class, $flower);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('flowers_index', [
                'id' => $flower->getId(),
            ]);
        }

        return $this->render('flowers/edit.html.twig', [
            'flower' => $flower,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="flowers_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Flowers $flower): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flower->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($flower);
            $entityManager->flush();
        }

        return $this->redirectToRoute('flowers_index');
    }
}
