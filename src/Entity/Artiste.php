<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\UX\Turbo\Attribute\Broadcast;


#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
#[Vich\Uploadable]
class Artiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomartiste = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $datenaissance = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $datedeces = null;

    #[Vich\UploadableField(mapping: "artiste_img", fileNameProperty: "imgartiste")]
    private ?File $logoFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imgartiste = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomartiste(): ?string
    {
        return $this->nomartiste;
    }

    public function setNomartiste(?string $nomartiste): static
    {
        $this->nomartiste = $nomartiste;
        return $this;
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(?\DateTimeInterface $datenaissance): static
    {
        $this->datenaissance = $datenaissance;
        return $this;
    }

    public function getDatedeces(): ?\DateTimeInterface
    {
        return $this->datedeces;
    }

    public function setDatedeces(?\DateTimeInterface $datedeces): static
    {
        $this->datedeces = $datedeces;
        return $this;
    }

    public function getImgartiste(): ?string
    {
        return $this->imgartiste;
    }

    public function setImgartiste(?string $imgartiste): static
    {
        $this->imgartiste = $imgartiste;
        return $this;
    }

    public function getLogoFile(): ?File
    {
        return $this->logoFile;
    }

    public function setLogoFile(?File $logoFile): void
    {
        $this->logoFile = $logoFile;
    }
}
