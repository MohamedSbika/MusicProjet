<?php

namespace App\Entity;

use App\Repository\TitreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\UX\Turbo\Attribute\Broadcast;
use Symfony\Component\Validator\Constraints as Assert;



#[ORM\Entity(repositoryClass: TitreRepository::class)]
#[Vich\Uploadable]class Titre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomtitre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $imgtitre = null;

    #[ORM\ManyToMany(targetEntity: Artiste::class)]
    private Collection $artiste;


    #[Vich\UploadableField(mapping: 'titre_logo', fileNameProperty: 'imgtitre')]
    private ?File $logoFile = null;

    #[ORM\Column(length: 255)]
    #[Assert\Url]
    private ?string $lien = null;

    public function __construct()
    {
        $this->artiste = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomtitre(): ?string
    {
        return $this->nomtitre;
    }

    public function setNomtitre(string $nomtitre): static
    {
        $this->nomtitre = $nomtitre;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getImgtitre(): ?string
    {
        return $this->imgtitre;
    }

    public function setImgtitre(string $imgtitre): static
    {
        $this->imgtitre = $imgtitre;

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

    /**
     * @return Collection<int, Artiste>
     */
    public function getArtiste(): Collection
    {
        return $this->artiste;
    }

    public function addArtiste(Artiste $artiste): static
    {
        if (!$this->artiste->contains($artiste)) {
            $this->artiste->add($artiste);
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): static
    {
        $this->artiste->removeElement($artiste);

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): static
    {
        $this->lien = $lien;

        return $this;
    }



}
