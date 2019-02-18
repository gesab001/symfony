<?php

namespace App\Controller;

use App\Entity\RecentHymns2;
use App\Form\RecentHymns2Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recent/hymns2")
 */
class RecentHymns2Controller extends AbstractController
{
    /**
     * @Route("/", name="recent_hymns2_index", methods={"GET"})
     */
    public function index(): Response
    {

        $recentHymns2s = $this->getDoctrine()
            ->getRepository(RecentHymns2::class)
            ->findBy(array(), array('addedDate'=> 'DESC'));

        return $this->render('recent_hymns2/index.html.twig', [
            'recent_hymns2s' => $recentHymns2s,
        ]);
    }

    /**
     * @Route("/new", name="recent_hymns2_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $recentHymns2 = new RecentHymns2();
        $form = $this->createForm(RecentHymns2Type::class, $recentHymns2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recentHymns2);
            $entityManager->flush();

            return $this->redirectToRoute('recent_hymns2_index');
        }

        return $this->render('recent_hymns2/new.html.twig', [
            'recent_hymns2' => $recentHymns2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recent_hymns2_show", methods={"GET"})
     */
    public function show(RecentHymns2 $recentHymns2): Response
    {
        return $this->render('recent_hymns2/show.html.twig', [
            'recent_hymns2' => $recentHymns2,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="recent_hymns2_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RecentHymns2 $recentHymns2): Response
    {
        $form = $this->createForm(RecentHymns2Type::class, $recentHymns2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recent_hymns2_index', [
                'id' => $recentHymns2->getId(),
            ]);
        }

        return $this->render('recent_hymns2/edit.html.twig', [
            'recent_hymns2' => $recentHymns2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recent_hymns2_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RecentHymns2 $recentHymns2): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recentHymns2->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recentHymns2);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recent_hymns2_index');
    }
}
