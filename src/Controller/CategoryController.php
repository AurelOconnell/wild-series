<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController 
{
    #[Route('/category/', name: 'category_index')]
  public function index(CategoryRepository $categoryRepository): Response
  {
    $categories = $categoryRepository->findAll();
    return $this->render('category/index.html.twig', [
      'categories' => $categories,
    ]);
  }

    #[Route('/category/{categoryName}', name: 'category_show')]
  public function show(int $id, CategoryRepository $categoryRepository): Response
  {
    $category = $categoryRepository->findOneBy(['id' => $id]);

    if (!$category) {
      throw $this->createNotFoundException(
        'No program with id : ' . $id . ' found in program\'s table.'
      );
    }

    return $this->render('category/show.html.twig', [
      'category' => $category,
    ]);
  }
}