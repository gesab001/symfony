<?php

namespace App\Controller\Egw;

use App\Entity\Egw\Books;
use App\Entity\Egw\EgwWritingsComplete;
use App\Entity\Kjv;
use App\Form\Egw\BooksType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/egw/books")
 */
class BooksController extends Controller
{

    function getCurrentID($totalParagraphs){
        $totalVerses = $totalParagraphs;
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

    /**
     * @Route("/", name="egw_books_index", methods={"GET"})
     */
    public function index(): Response
    {
        $books = $this->getDoctrine()
            ->getRepository(Books::class, 'egw')
            ->findAll();

        return $this->render('egw/books/index.html.twig', [
            'books' => $books,
        ]);
    }

    public function getStartingID($bookcode){

        $em = $this->getDoctrine()->getManager('egw');

        // Get some repository of data, in our case we have an Appointments entity
        $hymnsRepository = $em->getRepository(EgwWritingsComplete::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allHymnsQuery = $hymnsRepository->createQueryBuilder('w')
            ->where('w.bookcode = :bookcode')
//            ->andWhere('w.id > :id')
            ->setParameter('bookcode', $bookcode)
            ->getQuery();

        // to get just one result:
        $result = $allHymnsQuery->setMaxResults(1)->getOneOrNullResult();
        $startingID = $result->getID();
        return $startingID;
    }

    public function getParagraph($bookcode, $startingID){
        $repository = $this->getDoctrine()->getRepository(EgwWritingsComplete::class, 'egw');
        $products = $repository->findBy(
            ['bookcode' => $bookcode]
        );

//        $userprofile = new UserController();
//        $user = $this->getUserProfile();
        $totalParagraphs = count($products);
        $currentID = $this->getCurrentID($totalParagraphs) + $startingID - 1;
        $currentParagraph = $repository->find($currentID);
        return $currentParagraph;
    }
    /**
     * @Route("/today", name="egw_books_today", methods={"GET"})
     */
    public function today()
    {
        $paragraphs = array();

        $codeslist = array('DA', 'CD', 'CG', '1MCP', '2MCP', 'PP', 'PK', 'AA', 'MH', 'GC');
        foreach ($codeslist as $bookcodes){
            $startingID = $this->getStartingID($bookcodes);
            $currentParagraph = $this->getParagraph($bookcodes, $startingID);
            array_push($paragraphs, $currentParagraph);

        }

        return $this->render('books/today.html.twig', [
        'paragraphs' => $paragraphs
    ]);
    }

    /**
     * @Route("/new", name="egw_books_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $book = new Books();
        $form = $this->createForm(BooksType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('egw_books_index');
        }

        return $this->render('egw/books/new.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{bookcode}", name="egw_books_show", methods={"GET"})
     */
    public function show(Books $book): Response
    {
        return $this->render('egw/books/show.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route("/{bookcode}/edit", name="egw_books_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Books $book): Response
    {
        $form = $this->createForm(BooksType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('egw_books_index', [
                'bookcode' => $book->getBookcode(),
            ]);
        }

        return $this->render('egw/books/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{bookcode}", name="egw_books_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Books $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getBookcode(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('egw_books_index');
    }
}
