<?php

namespace App\Controller;

use App\Form\SneakersType;
use App\Entity\Sneakers;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $user = $this->getUser();
        $sneakers = $managerRegistry->getRepository(Sneakers::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'website' => 'Admin',
            'user' => $user,
            'sneakers' => $sneakers,
        ]);
    }

    /**
     * @Route("/sneaker/new"), name="sneaker_new")
     */
    public function newSneaker(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sneaker = new Sneakers();

        $form = $this->createForm(SneakersType::class, $sneaker);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sneaker);
            $entityManager->flush();
            return $this->redirectToRoute('admin_index', [], Response::HTTP_SEE_OTHER);

        }
        return $this->renderForm('admin/sneakers/new_sneaker.html.twig', [
            'sneaker'   => $sneaker,
            'form'      => $form,
        ]);
    }

    /**
     * @Route("/sneaker/{id}", name="sneaker_show")
     */
    public function showSneaker(Sneakers $sneaker): Response {
        return $this->render('sneakers/show.html.twig', [
            'sneaker' =>$sneaker,
        ]);
    }
     /**
      * @Route("/sneaker/{id}/edit", name="sneaker_edit")
      */
     public function editSneaker(Request $request, Sneakers $sneaker, EntityManagerInterface $entityManager) : Response {
         $form = $this->createForm(SneakersType::class, $sneaker);
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid()) {
             $entityManager->flush();

             return  $this->redirectToRoute('admin_index', [], Response::HTTP_SEE_OTHER);
         }

         return $this->renderForm('admin/sneakers/edit_sneaker.html.twig', [
             'sneaker'  => $sneaker,
             'form'     => $form,
         ]);
     }

     /**
      * @Route("/sneaker/{id}", name="sneaker_delete")
      */
     public function deleteSneaker(Request $request, Sneakers $sneaker, EntityManagerInterface $entityManager): Response
     {
         if ($this->isCsrfTokenValid('delete' . $sneaker->getId(), $request->request->get('_token')))
         {
          $entityManager->remove($sneaker);
          $entityManager->flush();
          $this->addFlash('succes', 'Votre article à bien été supprimé');
         }
         return $this->redirectToRoute('admin_index', [], Response::HTTP_SEE_OTHER);
     }
}
