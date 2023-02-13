<?php

namespace App\Controller;

use App\Entity\Club;
use App\Form\ClubType;
use App\Repository\ClubRepository;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class TaskController extends AbstractController
{

    private $clubRepository;


    public function __construct(ClubRepository $clubRepository)
    {
        $this->clubRepository = $clubRepository;
    }

    /**
    * @Route("/home" , name = "club_list_show")
    */
    public function index()
    {
        $clubs = $this->clubRepository->findAll();
        return $this->render('home.html.twig' , [
            'clubs' => $clubs 
        ]);
    }

/**
 * @Route("/club/{id}" , name = "club_show")
 */
public function showClub($id)
{
    $club = $this->clubRepository->find($id);
    return $this->render('show.html.twig' , [
        'club' => $club 
    ]);
}

/**
 * @Route("/add" , name = "add_list_show")
 */
public function addClub(Request $request)
{
    $club = new Club();

    $form = $this->createForm(ClubType::class, $club);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

        $club = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($club);
        $entityManager->flush();
        
        $this->addFlash(
            'Success',
            'Club added successfully!'
        );

        return $this->redirectToRoute('club_list_show');

    }

    return $this->render('add.html.twig', [
        'club' => $form->createView(),
    ]);
}

/**
 * @Route("/edit/{id}" , name = "edit_list_show")
 */
public function editClub(Club $club , Request $request)
{
    $form = $this->createForm(ClubType::class, $club);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

        $club = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($club);
        $entityManager->flush();

        $this->addFlash(
            'Success',
            'Club edited successfully!'
        );

        return $this->redirectToRoute('club_list_show');

    }

    return $this->render('edit.html.twig', [
        'club' => $form->createView(),
    ]);
}

/**
 * @Route("/delete/{id}" , name = "delete_list_show")
 */
public function deleteClub(Club $club)
{

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($club);
        $entityManager->flush();

        $this->addFlash(
            'Success',
            'Club removed successfully!'
        );

        return $this->redirectToRoute('club_list_show');

    }

}

?>