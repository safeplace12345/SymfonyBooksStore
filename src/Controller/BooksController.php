<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    private $em;
    public  function __construct(EntityManagerInterface $em)
    {
        $this->em = $em->getRepository(Book::class);
    }

    /**
     * @Route("/", name="app", methods={"GET", "HEAD"})
     */
    public function index(): Response
    {
        $books = $this->em->findAll();
        $res = [];
        foreach ($books as $book) {
            array_push($res, [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'isbn_code' => $book->getIsbnCode(),
                'authorName' => $book->getPublisher()->getName(),
                'authorSurName' => $book->getPublisher()->getSurname(),
                'year_of_publication' => $book->getYearOfPublication()->getTimestamp(),
            ]);
        }
        return $this->render('index.html.twig', ['books' => $res]);
    }

    /**
     * @Route("/books/edit/{id}", name="app_edit", methods={"GET", "HEAD"})
     */
    public function edit($id): Response
    {
        $book = $this->em->find($id);
        $res = [];
        $res['id'] = $book->getId();
        $res['title'] = $book->getTitle();
        $res['isbn_code'] = $book->getIsbnCode();
        return $this->render('edit.html.twig', $res);
    }

    /**
     * @Route("/books", name="app_getBook", methods={"GET", "HEAD"})
     */
    public function getBooks(): JsonResponse
    {
        $books = $this->em->findAll();
        $res = [];
        foreach ($books as $book) {
            array_push($res, [
                'title' => $book->getTitle()
            ]);
        }
        return $this->json($res);
    }

    /**
     * @Route("/books", name="app_addBook", methods={"POST", "HEAD"})
     */
    public function addBook(Request $req,  EntityManagerInterface $em): RedirectResponse
    {
        $payload = json_decode($req->getContent(), true);
        if ($req->getContentType() !== 'application/json') {
            $payload = $req->request->all();
        }
        $author = new Author();
        $author->setName($payload['authorName']);
        $author->setSurname($payload['authorSurName']);
        $author->setCountryOfBirth($payload['country']);
        $author->setYearOfBirth(\DateTime::createFromFormat('Y-m-d', "2018-09-09"));

        $book = new Book();
        $book->setTitle($payload['title']);
        $book->setPublisher($author);
        $book->setIsbnCode($payload['isbn']);
        $book->setYearOfPublication(\DateTime::createFromFormat('Y-m-d', "2018-09-09"));

        $em->persist($book);
        $em->flush();
        return $this->redirect('/');
    }

    /**
     * @Route("/books/editComplete", name="app_editComplete", methods={"POST", "HEAD"})
     */
    public function editBook(Request $req, EntityManagerInterface $em): RedirectResponse
    {
        $payload = json_decode($req->getContent(), true);
        if ($req->getContentType() !== 'application/json') {
            $payload = $req->request->all();
        }
        $book = $this->em->find($payload['id']);

        if ($payload['title']) $book->setTitle($payload['title']);
        if ($payload['isbn']) $book->setIsbnCode($payload['isbn']);

        $em->persist($book);
        $em->flush();
        return $this->redirect('/');
    }
    
    /**
     * @Route("/books/delete/{id}", name="app_deleteBook", methods={"GET", "HEAD"})
     */
    public function deleteBook($id, EntityManagerInterface $em): RedirectResponse
    {
        $book = $this->em->find($id);
        $em->remove($book);
        $em->flush();
        
        return $this->redirect('/');
    }
}
