<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UrunRepository")
 */
class Urun
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $isim;

    /**
     * @ORM\Column(type="integer")
     */
    private $fiyat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $durum;

    /**
     * @ORM\Column(type="datetime")
     */
    private $olusturulmaTarihi;

    /**
     * @ORM\Column(type="datetime")
     */
    private $guncellenmeTarihi;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Kategori", inversedBy="uruns")
     * @ORM\JoinColumn(name="kategori_id", referencedColumnName="id")
     */
    private $kategori;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsim(): ?string
    {
        return $this->isim;
    }

    public function setIsim(string $isim): self
    {
        $this->isim = $isim;

        return $this;
    }

    public function getFiyat(): ?int
    {
        return $this->fiyat;
    }

    public function setFiyat(int $fiyat): self
    {
        $this->fiyat = $fiyat;

        return $this;
    }

    public function getDurum(): ?string
    {
        return $this->durum;
    }

    public function setDurum(?string $durum): self
    {
        $this->durum = $durum;

        return $this;
    }

    public function getOlusturulmaTarihi(): ?\DateTimeInterface
    {
        return $this->olusturulmaTarihi;
    }

    public function setOlusturulmaTarihi(\DateTimeInterface $olusturulmaTarihi): self
    {
        $this->olusturulmaTarihi = $olusturulmaTarihi;

        return $this;
    }

    public function getGuncellenmeTarihi(): ?\DateTimeInterface
    {
        return $this->guncellenmeTarihi;
    }

    public function setGuncellenmeTarihi(\DateTimeInterface $guncellenmeTarihi): self
    {
        $this->guncellenmeTarihi = $guncellenmeTarihi;

        return $this;
    }

    public function getKategori(): ?Kategori
    {
        return $this->kategori;
    }

    public function setKategori(?Kategori $kategori): self
    {
        $this->kategori = $kategori;

        return $this;
    }

}
