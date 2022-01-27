<?php

namespace App\Controller;

use App\Entity\Emprint;
use App\Entity\EmprintLivre;
use App\Entity\Livre;
use App\Repository\EmprintRepository;
use App\Repository\LivreRepository;
use App\Repository\UserRepository;
use App\Service\Cart\CartService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CheckOutController extends AbstractController
{
    /**
     * @Route("/check/out", name="check_out")
     */
    public function index(CartService $cartService): Response
    {
        $livres = $cartService->getAllLivreInCart();

        return $this->render('check_out/index.html.twig', [
            'controller_name' => 'CheckOutController',
            'livres' => $livres,
            'errorMessage' => false
        ]);
    }
    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(CartService $cartService, Livre $livre): RedirectResponse
    {
        // if ($this->getUser()) {
        $cartService->remove($livre->getId());
        return $this->redirectToRoute('check_out', ["id" => $livre->getId()]);
    }
    /**
     * @Route("/emprint", name="emprint")
     */
    public function emprint(CartService $cartService, LivreRepository $livreRepository, AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            $LivreToEmprint = $cartService->getAllLivreInCart();
            $emprint = new Emprint();
            $user = $this->getUser();

            if (!$user->haveMoreThanThreeBooks()) {

                $entityManager = $this->getDoctrine()->getManager();
                foreach ($LivreToEmprint as $livre) {
                    $dbLivre = $livreRepository->findOneBy(["id" => $livre["livre"]->getId()]);
                    if ($dbLivre->getNbExemplaires() > 1) {
                        $dbLivre->setNbExemplaires($dbLivre->getNbExemplaires() - 1);
                        $l = new EmprintLivre();
                        $l->setUser($user);
                        $l->setLivre($livre["livre"]);
                        $l->setState("Non Remis");
                        $l->setEmprint($emprint);
                        $entityManager->persist($l);
                        $user->addEmprint($l);
                        $emprint->addEmprintedLivres($l);
                        $cartService->remove($dbLivre->getId());
                    }
                }

                $emprint->setDateEmprint(new DateTime());
                $emprint->setUser($user);
                $entityManager->persist($emprint);
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('librairy');
            }
            return $this->render('check_out/index.html.twig', [
                'controller_name' => 'CheckOutController',
                'livres' => $LivreToEmprint,
                'errorMessage' => true
            ]);
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->redirectToRoute('app_login', ['last_username' => $lastUsername, 'error' => $error]);
    }
}
