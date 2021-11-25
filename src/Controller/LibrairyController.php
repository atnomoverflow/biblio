<?php

namespace App\Controller;

use App\Entity\Livre;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LibrairyController extends AbstractController
{
    /**
     * @Route("/librairy", name="librairy")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $bookRepo = $this->getDoctrine()->getRepository(Livre::class);

        // Find all the data on the Appointments table, filter your query as you need
        $allBooksQuery = $bookRepo->createQueryBuilder('L')
            ->getQuery();

        // Paginate the results of the query
        $allBooks = $paginator->paginate(
            // Doctrine Query, not results
            $allBooksQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            6
        );

        return $this->render('librairy/index.html.twig', [
            'controller_name' => 'LibrairyController',
            'books'=>$allBooks
        ]);
    }
}
