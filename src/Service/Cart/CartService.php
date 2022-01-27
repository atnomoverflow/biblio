<?php

namespace App\Service\Cart;

use App\Repository\LivreRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    private $session;
    private $livreRepository;
    function __construct(SessionInterface $session, LivreRepository $livreRepository)
    {
        $this->session = $session;
        $this->livreRepository = $livreRepository;
    }
    public function add($id)
    {
        $panier = $this->session->get('panier', []);
        $panier[$id] = 1;
        dump($panier);
        $this->session->set('panier', $panier);
    }
    public function remove($id)
    {
        $panier = $this->session->get('panier', []);
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        dump($panier);
        $this->session->set('panier', $panier);
    }
    public function getAllLivreInCart(): array
    {
        $panier = $this->session->get('panier', []);
        dump($panier);

        $livreData = [];
        foreach ($panier as $id => $quantite) {

            $livreData[] = [
                'livre' => $this->livreRepository->find($id),
                'quantite' => $quantite
            ];
        }
        return $livreData;
    }
    public function removeAll():void{
        $this->session->set('panier', []);
    }
}
