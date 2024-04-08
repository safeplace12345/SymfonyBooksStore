<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private string $title;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private \DateTimeInterface $year_of_publication;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private int $isbn_code;

    /**
     * @ORM\OneToOne(targetEntity=Author::class, inversedBy="books", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private Author $publisher;

    public function setId(int $id): ?self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getYearOfPublication(): ?\DateTimeInterface
    {
        return $this->year_of_publication;
    }

    public function setYearOfPublication(\DateTimeInterface $year_of_publication): self
    {
        $this->year_of_publication = $year_of_publication;

        return $this;
    }

    public function getIsbnCode(): ?int
    {
        return $this->isbn_code;
    }

    public function setIsbnCode(int $isbn_code): self
    {
        $this->isbn_code = $isbn_code;

        return $this;
    }

    public function getPublisher(): ?Author
    {
        return $this->publisher;
    }

    public function setPublisher(Author $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }
}
