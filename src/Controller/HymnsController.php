<?php

namespace App\Controller;

use App\Entity\Hymns;
use App\Form\HymnsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hymns")
 */
class HymnsController extends AbstractController
{
    /**
     * @Route("/", name="hymns_index", methods={"GET"})
     */
    public function index(): Response
    {
        $hymns = $this->getDoctrine()
            ->getRepository(Hymns::class)
            ->findAll();

        return $this->render('hymns/index.html.twig', [
            'hymns' => $hymns,
        ]);
    }

    /**
     * @Route("/new", name="hymns_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hymn = new Hymns();
        $form = $this->createForm(HymnsType::class, $hymn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hymn);
            $entityManager->flush();

            return $this->redirectToRoute('hymns_index');
        }

        return $this->render('hymns/new.html.twig', [
            'hymn' => $hymn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hymns_show", methods={"GET"})
     */
    public function show(Hymns $hymn): Response
    {
        return $this->render('hymns/show.html.twig', [
            'hymn' => $hymn,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hymns_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hymns $hymn): Response
    {
        $form = $this->createForm(HymnsType::class, $hymn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hymns_index', [
                'id' => $hymn->getId(),
            ]);
        }

        return $this->render('hymns/edit.html.twig', [
            'hymn' => $hymn,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hymns_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Hymns $hymn): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hymn->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hymn);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hymns_index');
    }
}
