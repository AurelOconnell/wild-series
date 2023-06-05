<?php
//src/Controler/ProgramController.php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\ProgramType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
  #[Route('/new', name: 'new')]
  public function new(Request $request, ProgramRepository $programRepository): Response
  {
    $program = new Program();

    $form = $this->createForm(ProgramType::class, $program);

    $form->handleRequest($request);

    if ($form->isSubmitted()) {
      $programRepository->save($program, true);
      return $this->redirectToRoute('program_index');
    }

    return $this->render('program/new.html.twig', [
      'form' => $form,
    ]);
  }

  #[Route('/', name: 'index')]
  public function index(ProgramRepository $programRepository): Response
  {
    $programs = $programRepository->findAll();
    return $this->render('program/index.html.twig', [
      'programs' => $programs,
    ]);
  }

  #[Route('/show/{programId<^[0-9]+$>}', name: 'show')]
  public function show(ProgramRepository $programRepository, Program $programId): Response
  {
//    $program = $programRepository->findOneBy(['id' => $id]);
    $seasons = $programId->getSeasons();

    if (!$programId) {
      throw $this->createNotFoundException(
        'No program with id : ' . $programId . ' found in program\'s table.'
      );
    }

    return $this->render('program/show.html.twig', [
      'program' => $programId,
      'seasons' => $seasons,
    ]);
  }

  #[Route('/program/{programId}/seasons/{seasonId}', name: 'season_show')]
  public function showSeason(Program $programId, Season $seasonId) : Response
  {
    $episodes = $seasonId->getEpisodes();

    return $this->render('program/season_show.html.twig', [
      'program' => $programId,
      'season' => $seasonId,
      'episodes' => $episodes,
    ]);
  }

  #[Route('/program/{programId}/season/{seasonId}/episode/{episodeId}', name: 'episode_show')]
  public function showEpisode(Program $programId, Season $seasonId, Episode $episodeId) : Response
  {
    return $this->render('program/episode_show.html.twig', [
      'program' => $programId,
      'season' => $seasonId,
      'episode' => $episodeId,
    ]);
  }
}
