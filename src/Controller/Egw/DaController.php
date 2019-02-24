<?php

namespace App\Controller\Egw;

use App\Entity\Egw\Da;
use App\Form\Egw\DaType;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
/**
 * @Route("/egw/da")
 */
class DaController extends AbstractController
{
    /**
     * @Route("/", name="egw_da_index", methods={"GET"})
     */
    public function index(): Response
    {
        $das = $this->getDoctrine()
            ->getRepository(Da::class, 'egw')
            ->findAll();

        return $this->render('egw/da/index.html.twig', [
            'das' => $das,
        ]);
    }

    function getCurrentID(){
        $totalVerses = 2590;
        date_default_timezone_set("Pacific/Auckland");
        $originalDate = strtotime("2016-12-31 14:45:00");
        $dateToday = date("Y-m-d H:i");
        $currentDate = strtotime("now");
        $difference_in_minutes = round(($currentDate-$originalDate)/60/60/24)+1;
        $id = $difference_in_minutes;
        while ($id>$totalVerses){
            $id = $id-$totalVerses;
        }
        return $id;
    }

    public function getTotalParagraphs($book){
        $book = 'DA';

    }
    /**
     * @Route("/new", name="egw_da_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $da = new Da();
        $form = $this->createForm(DaType::class, $da);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager('egw');
            $entityManager->persist($da);
            $entityManager->flush();

            return $this->redirectToRoute('egw_da_index');
        }

        return $this->render('egw/da/new.html.twig', [
            'da' => $da,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="egw_da_show", methods={"GET"})
     *
     */
    public function show(Request $request, $id)
    {
//        $id = $this->getCurrentID();
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
        return $this->render('egw/da/show.html.twig', [
            'da' => $da,


        ]);
//        return $this->render('egw/da/show.html.twig', [
//            'da' => $da,
//        ]);
    }

    /**
     * @Route("/today", name="egw_da_show")
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
        return $this->render('egw/da/show.html.twig', [
            'da' => $da,


        ]);
//        return $this->render('egw/da/show.html.twig', [
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
     * @Route("/{id}/edit", name="egw_da_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Da $da): Response
    {
        $form = $this->createForm(DaType::class, $da);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager('egw')->flush();

            return $this->redirectToRoute('egw_da_index', [
                'id' => $da->getId(),
            ]);
        }

        return $this->render('egw/da/edit.html.twig', [
            'da' => $da,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="egw_da_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Da $da): Response
    {
        if ($this->isCsrfTokenValid('delete'.$da->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager('egw');
            $entityManager->remove($da);
            $entityManager->flush();
        }

        return $this->redirectToRoute('egw_da_index');
    }
}
