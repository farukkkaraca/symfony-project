<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\KategoriRepository")
 */
class Kategori
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $isim;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Urun", mappedBy="kategori")
     */
    private $uruns;

    public function __construct()
    {
        $this->uruns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsim(): ?string
    {
        return $this->isim;
    }

    public function setIsim(?string $isim): self
    {
        $this->isim = $isim;

        return $this;
    }

    /**
     * @return Collection|Urun[]
     */
    public function getUruns(): Collection
    {
        return $this->uruns;
    }

    public function addUrun(Urun $urun): self
    {
        if (!$this->uruns->contains($urun)) {
            $this->uruns[] = $urun;
            $urun->setKategori($this);
        }

        return $this;
    }

    public function removeUrun(Urun $urun): self
    {
        if ($this->uruns->contains($urun)) {
            $this->uruns->removeElement($urun);
            // set the owning side to null (unless already changed)
            if ($urun->getKategori() === $this) {
                $urun->setKategori(null);
            }
        }

        return $this;
    }
}
