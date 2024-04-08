<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OriginRepository::class)
 */
class Origin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Author::class, mappedBy="countryOfBirth")
     */
    private $country;

    public function __construct()
    {
        $this->country = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Author>
     */
    public function getCountry(): Collection
    {
        return $this->country;
    }

    public function addCountry(Author $country): self
    {
        if (!$this->country->contains($country)) {
            $this->country[] = $country;
            $country->setCountryOfBirth($this);
        }

        return $this;
    }

    public function removeCountry(Author $country): self
    {
        if ($this->country->removeElement($country)) {
            // set the owning side to null (unless already changed)
            if ($country->getCountryOfBirth() === $this) {
                $country->setCountryOfBirth(null);
            }
        }

        return $this;
    }
}
