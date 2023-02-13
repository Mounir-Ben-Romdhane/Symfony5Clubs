<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    #[Route('/register', name: 'app_register')]
    public function registerUser(Request $request)
    {

        if ($this->getUser()) {
            return $this->redirectToRoute('club_list_show');
        }
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();
            $password_hashed = $this->passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password_hashed);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            $this->addFlash(
                'Success',
                'user added successfully!'
            );

            return $this->redirectToRoute('app_login');

        }

        return $this->render('register/index.html.twig', [
            'user' => $form->createView(),
        ]);
    }
}
