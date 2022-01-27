<?php

namespace App\Controller;

use App\Entity\Filter;
use App\Entity\Livre;
use App\Form\FilterType;
use App\Repository\LivreRepository;
use App\Service\Cart\CartService;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LibrairyController extends AbstractController
{
    /**
     * @Route("/librairy", name="librairy")
     */
    public function index(LivreRepository $repository, Request $request): Response
    {
        $data = new Filter();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(FilterType::class, $data);
        $form->handleRequest($request);
        [$min, $max] = $repository->findMinMax();
        $allBooks = $repository->findSearch($data, true);
        return $this->render('librairy/index.html.twig', [
            'controller_name' => 'LibrairyController',
            'books' => $allBooks,
            'form' => $form->createView(),
            'min' => $min,
            'max' => $max,
        ]);
    }
    /**
     * @Route("/librairy/{id}", name="livreDetail")
     */
    public function livreDetail(Request $request, Livre $livre): Response
    {
        return $this->render('librairy/detail.html.twig', [
            'controller_name' => 'LibrairyController',
            'book' => $livre
        ]);
    }
    /**
     * @Route("/order/{id}", name="order")
     */
    public function order(Request $request, Livre $livre, CartService $cart): RedirectResponse
    {
        $cart->add($livre->getId());
        return $this->redirectToRoute('livreDetail',["id"=>$livre->getId()]);

    }
}
