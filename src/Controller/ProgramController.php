<?php
//src/Controler/ProgramController.php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
  #[Route('/', name: 'index')]
  public function index(ProgramRepository $programRepository): Response
  {
    $programs = $programRepository->findAll();
    return $this->render('program/index.html.twig', [
      'programs' => $programs,
    ]);
  }

  #[Route('/show/{id<^[0-9]+$>}', name: 'show')]
  public function show(int $id, ProgramRepository $programRepository): Response
  {
    $program = $programRepository->findOneBy(['id' => $id]);
    $seasons = $program->getSeasons();

    if (!$program) {
      throw $this->createNotFoundException(
        'No program with id : ' . $id . ' found in program\'s table.'
      );
    }

    return $this->render('program/show.html.twig', [
      'program' => $program,
      'seasons' => $seasons,
    ]);
  }

  #[Route('/program/{programId}/seasons/{seasonId}', name: 'season_show')]
  public function showSeason(int $programId, int $seasonId, SeasonRepository $seasonRepository) : Response
  {
    $season = $seasonRepository->find($seasonId);
    $programId = $season->getProgram();
    $episodes = $season->getEpisodes();

    return $this->render('program/season_show.html.twig', [
      'program' => $programId,
      'season' => $season,
      'episodes' => $episodes,
    ]);
  }

  #[Route('/program/{programId}/season/{seasonId}/episode/{episodeId}', name: 'program_episode_show')]
  public function showEpisode(Program $program, Season $season, Episode $episode) : Response
  {
    return $this->render('program/episode_show.html.twig', [
      'program' => $program,
      'season' => $season,
      'episode' => $episode,
    ]);
  }
}
