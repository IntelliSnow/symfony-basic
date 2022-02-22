<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    public function __construct(
        private CategoryRepository $repository,
    )
    {
    }

    #[Route('/categories', name: 'categories', methods: ['GET'])]
    public function list(): Response
    {
        return $this->render('categories/index.html.twig', [
            'categories' => $this->repository->findAll(),
        ]);
    }

    #[Route('/create', name: 'category_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $data = $form->getData()) {
            $this->repository->persist($data);
            $this->repository->flush();

            return $this->redirectToRoute('categories');
        }

        return $this->renderForm('generic_form.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/update/{id}', name: 'category_update', methods: ['GET', 'POST'])]
    public function update(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->repository->flush();

            return $this->redirectToRoute('categories');
        }

        return $this->renderForm('generic_form.html.twig', [
            'form' => $form,
        ]);
    }
}
