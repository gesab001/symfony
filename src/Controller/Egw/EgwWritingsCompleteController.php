<?php

namespace App\Controller\Egw;

use App\Entity\Egw\EgwWritingsComplete;
use App\Form\Egw\EgwWritingsCompleteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/egw/egw/writings/complete")
 */
class EgwWritingsCompleteController extends AbstractController
{
    /**
     * @Route("/", name="egw_egw_writings_complete_index", methods={"GET"})
     */
    public function index(): Response
    {
        $egwWritingsCompletes = $this->getDoctrine()
            ->getRepository(EgwWritingsComplete::class, 'egw')
            ->findAll();

        return $this->render('egw/egw_writings_complete/index.html.twig', [
            'egw_writings_completes' => $egwWritingsCompletes,
        ]);
    }

    /**
     * @Route("/new", name="egw_egw_writings_complete_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $egwWritingsComplete = new EgwWritingsComplete();
        $form = $this->createForm(EgwWritingsCompleteType::class, $egwWritingsComplete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($egwWritingsComplete);
            $entityManager->flush();

            return $this->redirectToRoute('egw_egw_writings_complete_index');
        }

        return $this->render('egw/egw_writings_complete/new.html.twig', [
            'egw_writings_complete' => $egwWritingsComplete,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="egw_egw_writings_complete_show", methods={"GET"})
     */
    public function show(EgwWritingsComplete $egwWritingsComplete): Response
    {
        return $this->render('egw/egw_writings_complete/show.html.twig', [
            'egw_writings_complete' => $egwWritingsComplete,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="egw_egw_writings_complete_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EgwWritingsComplete $egwWritingsComplete): Response
    {
        $form = $this->createForm(EgwWritingsCompleteType::class, $egwWritingsComplete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('egw_egw_writings_complete_index', [
                'id' => $egwWritingsComplete->getId(),
            ]);
        }

        return $this->render('egw/egw_writings_complete/edit.html.twig', [
            'egw_writings_complete' => $egwWritingsComplete,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="egw_egw_writings_complete_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EgwWritingsComplete $egwWritingsComplete): Response
    {
        if ($this->isCsrfTokenValid('delete'.$egwWritingsComplete->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($egwWritingsComplete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('egw_egw_writings_complete_index');
    }
}
