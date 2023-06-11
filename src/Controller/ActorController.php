<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ActorRepository;


class ActorController extends AbstractController
{
    #[Route('/actor', name: 'app_actor')]
    public function index(): Response
    {
        return $this->render('actor/index.html.twig', [
            'controller_name' => 'ActorController',
        ]);
    }

    #[Route('/actor/{id}', name: 'app_actor_show')]
    public function show(int $id, ActorRepository $actorRepository): Response
    {
        $actor = $actorRepository->find($id);
    
    if (!$actor) {
        throw $this->createNotFoundException('Actor not found');
    }

    // Récupérer les séries associées à l'acteur
    $series = $actor->getPrograms();

    return $this->render('actor/show.html.twig', [
        'actor' => $actor,
        'series' => $series,
    ]);
    }
}
