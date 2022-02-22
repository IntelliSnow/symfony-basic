<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsController extends AbstractController
{
    public function __construct(
        private ProductRepository $repository,
    )
    {
    }

    #[Route('/products', name: 'products')]
    public function list(ProductRepository $repo): Response
    {
        return $this->render('products/index.html.twig', [
            'products' => $repo->findAll(),
        ]);
    }

    #[Route('/create', name: 'product_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $form = $this->createForm(ProductType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() /** your code */) {
            // here: use @psalm-trace $data ; it MUST know it is instance of Product. Uncomment next line when complete.

//            $this->repository->persist($data);
            $this->repository->flush();

            return $this->redirectToRoute('products');
        }

        return $this->renderForm('generic_form.html.twig', [
            'form' => $form,
        ]);
    }
}
