<?php

namespace App\Controller;

use App\Entity\Sneakers;
use App\Form\SneakersType;
use App\Repository\SneakersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sneakers")
 */
class SneakersController extends AbstractController
{
    /**
     * @Route("/", name="sneakers_index", methods={"GET"})
     */
    public function index(SneakersRepository $sneakersRepository): Response
    {
        return $this->render('sneakers/index.html.twig', [
            'sneakers' => $sneakersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sneakers_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sneaker = new Sneakers();
        $form = $this->createForm(SneakersType::class, $sneaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sneaker);
            $entityManager->flush();

            return $this->redirectToRoute('sneakers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sneakers/new.html.twig', [
            'sneaker' => $sneaker,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="sneakers_show", methods={"GET"})
     */
    public function show(Sneakers $sneaker): Response
    {
        return $this->render('sneakers/show.html.twig', [
            'sneaker' => $sneaker,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sneakers_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Sneakers $sneaker, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SneakersType::class, $sneaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('sneakers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sneakers/edit.html.twig', [
            'sneaker' => $sneaker,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="sneakers_delete", methods={"POST"})
     */
    public function delete(Request $request, Sneakers $sneaker, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sneaker->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sneaker);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sneakers_index', [], Response::HTTP_SEE_OTHER);
    }
}
