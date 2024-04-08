<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private string $surname;
    
    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private \DateTimeInterface $year_of_birth;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank
     */
    private int $phone;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private string $email;
    
    /**
     * @ORM\OneToOne(targetEntity=Book::class, mappedBy="publisher", cascade={"persist", "remove"})
     */
    private Book $books;
    
    /**
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
     */
    private int $country_of_birth;
    
    public function setId(int $id): ?self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getYearOfBirth(): ?\DateTimeInterface
    {
        return $this->year_of_birth;
    }

    public function setYearOfBirth(\DateTimeInterface $year_of_birth): self
    {
        $this->year_of_birth = $year_of_birth;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBooks(): ?Book
    {
        return $this->books;
    }

    public function setBooks(Book $books): self
    {
        // set the owning side of the relation if necessary
        if ($books->getPublisher() !== $this) {
            $books->setPublisher($this);
        }

        $this->books = $books;

        return $this;
    }

    public function getCountryOfBirth(): ?int
    {
        return $this->country_of_birth;
    }

    //TODO connect countries to authors
    public function setCountryOfBirth(int $countryOfBirth): self
    {
        $this->country_of_birth = $countryOfBirth;

        return $this;
    }
}
