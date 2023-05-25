<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController 
{
    #[Route('/category/', name: 'category_index')]
  public function index(CategoryRepository $categoryRepository): Response
  {
    $categories = $categoryRepository->findAll(); // pas program mais category à mettre
    return $this->render('category/index.html.twig', [
      'programs' => $categories,
    ]);
  }

    #[Route('/category/{categoryName}', name: 'category_show')]
  public function show(int $id, CategoryRepository $categoryRepository): Response
  {
    $categories = $categoryRepository->findAll(); // pas program mais category à mettre
    return $this->render('category/index.html.twig', [
      'programs' => $categories,
    ]);
  }
}