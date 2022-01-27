<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HistoryController extends AbstractController
{
    /**
     * @Route("/history", name="history")
     */
    public function index( AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            $user=$this->getUser();
            $emprints=$user->getEmprints();
            dump($user->getEmprints());
            return $this->render('history/index.html.twig', [
                'controller_name' => 'HistoryController',
                'emprints'=>$emprints
            ]);
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->redirectToRoute('app_login', ['last_username' => $lastUsername, 'error' => $error]);
    }
}
