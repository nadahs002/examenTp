<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class UtilisateurController extends AbstractController
{
    //#[Route('/utilisateur', name: 'app_utilisateur')]
    /*public function index(): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }*/


       /**
 * @Route("/utilisateur/new", name="new_utilisateur")
 * Method({"GET", "POST"})
 */
 public function new(Request $request , ManagerRegistry $registry) {
    $utilisateur = new Utilisateur();
    $form = $this->createForm(UtilisateurType::class,$utilisateur);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    $utilisateur = $form->getData();
    $entityManager = $registry->getManager();
    $entityManager->persist($utilisateur);
    $entityManager->flush();
    
    }
    return $this->render('utilisateur/new.html.twig',['form' => $form->createView()]);
    }

    /**
 * @Route("/ustilisateur/save")
 */
 public function save(Request $request , ManagerRegistry $registry) {
    $entityManager = $registry->getManager();
    $utilisateur = new Utilisateur();
    $utilisateur->setNom('Utilisateur 1');
    $utilisateur->setEmail('nnn');
    //$utilisateur->setRole;
    
    $entityManager->persist($utilisateur);
    $entityManager->flush();
    return new Response('Utilisateur enregisté avec id '.$utilisateur->getId());
    }
   



}
