<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('club_list_show');
        }

        return $this->render('profile/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    
}
