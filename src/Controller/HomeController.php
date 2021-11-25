<?php

namespace App\Controller;

use App\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LivreRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(LivreRepository $livres): Response
    {
        $bookRepo=$this->getDoctrine()->getRepository(Livre::class);
        $latestBooks=$bookRepo->findLastInserted();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'latest_books'=>$latestBooks
        ]);
    }
}
