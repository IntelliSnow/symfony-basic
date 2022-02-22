<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntryController extends AbstractController
{

    #[Route('/', name: 'entry', methods: ['GET'])]
    public function list(): Response
    {
        return $this->redirectToRoute('products');

    }

}
