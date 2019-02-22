<?php

namespace App\Controller;

use App\Entity\Hymns;
use App\Entity\Kjv;
use App\Entity\RecentHymns2;
use App\Form\HymnsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\UserProfile;
use Symfony\Component\Security\Core\Security;
use DateTimeInterface;
use DateTime;
/**
 * @Route("/hymns")
 */
class HymnsController extends AbstractController
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
     * @Route("/", name="hymns_index", methods={"GET"})
     */
    public function index(): Response
    {
        $user = $this->getUserProfile();
        $hymns = $this->getDoctrine()
            ->getRepository(Hymns::class)
            ->findAll();

        return $this->render('hymns/index.html.twig', [
            'user' => $user,
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
     * @Route("/{id}/{number}", name="hymns_show", methods={"GET"})
     */
    public function show(Request $request)
    {
        $id =  $request->get('id');
        $number =  $request->get('number');
        $this->updateHymn($id);
        $entityManager = $this->getDoctrine()->getManager();
        $hymn = $entityManager->getRepository(Hymns::class)->find($number);

        if (!$hymn) {
            throw $this->createNotFoundException(
                'No hymn found for id '.$number
            );
        }
        $user = $this->getUserProfile();
        return $this->render('hymns/show.html.twig', [
            'user' => $user,
            'hymn' => $hymn,
        ]);
    }

    public function updateHymn($id){
        $entityManager = $this->getDoctrine()->getManager();
        $hymnToUpdate = $entityManager->getRepository(RecentHymns2::class)->find($id);

        if (!$hymnToUpdate) {
            throw $this->createNotFoundException(
                'No hymn found for id '.$id
            );
        }

        $currentDate = date('Y-m-d H:i:s');
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $currentDate);
        $popularity = $hymnToUpdate->getPopularity() + 1;
        $hymnToUpdate->setPopularity($popularity);
        $hymnToUpdate->setAddedDate($date);
        $entityManager->flush();
    }
    /**
     * @Route("/{id}/edit", name="hymns_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hymns $hymn): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(HymnsType::class, $hymn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hymns_index', [
                'id' => $hymn->getId(),
            ]);
        }

        return $this->render('hymns/edit.html.twig', [
            'user' => $user,
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
