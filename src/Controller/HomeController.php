<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\UnderCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategoryRepository $categoryRepository, UnderCategoryRepository $underCategoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('home/index.html.twig', ['categories' => $categories]);
    }
}
