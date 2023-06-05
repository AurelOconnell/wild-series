<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController 
{
  #[Route('/new', name: 'new')]
  public function new(Request $request, CategoryRepository $categoryRepository): Response
  {
    $category = new Category();

    $form = $this->createForm(CategoryType::class, $category);

    $form->handleRequest($request);

    if ($form->isSubmitted()) {
      $categoryRepository->save($category, true);
      return $this->redirectToRoute('category_index');
    }

    return $this->render('category/new.html.twig', [
      'form' => $form,
    ]);
  }

    #[Route('/category/', name: 'category_index')]
  public function index(CategoryRepository $categoryRepository): Response
  {
    $categories = $categoryRepository->findAll();
    return $this->render('category/index.html.twig', [
      'categories' => $categories,
    ]);
  }

    #[Route('/category/{categoryName}', methods: ['GET'], name: 'category_show')]
  public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
  {
    $category = $categoryRepository->findOneBy(['name' => $categoryName]);

    if (!$category) {
      throw $this->createNotFoundException(
        'No category ' . $categoryName . ' found in category\'s table.'
      );
    }

    $programs = $programRepository->findBy(['category' => $category->getId()], ['id' => 'DESC'], 3, 0);

    return $this->render('category/show.html.twig', [
      'category' => $category,
      'programs' => $programs,
    ]);
  }

  
}