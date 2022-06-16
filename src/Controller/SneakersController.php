<?php

namespace App\Controller;

use App\Entity\Sneakers;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SneakersController extends AbstractController
{
    /**
     * @Route("/sneakers", name="sneakers")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $sneakers = $managerRegistry->getRepository(Sneakers::class)->findAll();
        return $this->render('sneakers/index.html.twig', [
            'controller_name' => 'SneakersController',
            'sneakers' => $sneakers,
        ]);
    }

    /**
     * @Route("/show/{id}", name="showsneaker")
     */
    public function showSneaker(Sneakers $sneaker): Response {
        return $this->render('sneakers/show.html.twig', [
            'sneaker' => $sneaker,
        ]);
    }
}

