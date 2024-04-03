<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    /**
     * @Route("/books/{name}", name="app_books")
     */
    public function index($name): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome '. $name.  ' to your new controller!',
            'path' => 'src/Controller/BooksController.php',
        ]);
    }
}
