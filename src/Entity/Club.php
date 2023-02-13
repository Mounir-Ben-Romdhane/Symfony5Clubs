<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 17,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    /**
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Your discription must be at least {{ limit }} characters long",
     *      maxMessage = "Your discription cannot be longer than {{ limit }} characters"
     * )
     */
    private ?string $discription = null;

    #[ORM\Column(length: 255)]
    /**
     * @Assert\Length(
     *      min = 5,
     *      max = 30,
     *      minMessage = "Your adresse must be at least {{ limit }} characters long",
     *      maxMessage = "Your adresse cannot be longer than {{ limit }} characters"
     * )
     */
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    /**
     * @Assert\Length(
     *      min = 5,
     *      max = 30,
     *      minMessage = "Your domaine must be at least {{ limit }} characters long",
     *      maxMessage = "Your domaine cannot be longer than {{ limit }} characters"
     * )
     */
    private ?string $domaine = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDiscription(): ?string
    {
        return $this->discription;
    }

    public function setDiscription(string $discription): self
    {
        $this->discription = $discription;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDomaine(): ?string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }
}
