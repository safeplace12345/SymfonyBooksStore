<?php

namespace APP\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;

class BooksController extends AbstractController {

    #[Route('/books', name: "books", methods: ['GET', 'HEAD'])]
    public function index(): Response {
        return $this->json([
            "message" => "Welcome",
            "Params" => "Params"
        ]);
    }
}