<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoriqueDepanneur
 *
 * @ORM\Table(name="historique")
 * @ORM\Entity
 */
class Historique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="historique_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date_remorquage", type="string", length=255, nullable=true)
     */
    private $dateRemorquage;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_depanneur", type="string", length=255, nullable=false)
     */
    private $nomDepanneur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kilometres", type="string", length=255, nullable=true)
     */
    private $kilometres;

    /**
     * @var string|null
     *
     * @ORM\Column(name="depart", type="string", length=255, nullable=true)
     */
    private $depart;

    /**
     * @var string|null
     *
     * @ORM\Column(name="destination", type="string", length=255, nullable=true)
     */
    private $destination;

  
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRemorquage(): ?string
    {
        return $this->dateRemorquage;
    }

    public function setDateRemorquage(?string $dateRemorquage): self
    {
        $this->dateRemorquage = $dateRemorquage;

        return $this;
    }

    public function getNomDepanneur(): ?string
    {
        return $this->nomDepanneur;
    }

    public function setNomDepanneur(string $nomDepanneur): self
    {
        $this->nomDepanneur = $nomDepanneur;

        return $this;
    }

    

    public function getKilometres(): ?string
    {
        return $this->kilometres;
    }

    public function setKilometres(?string $kilometres): self
    {
        $this->kilometres = $kilometres;

        return $this;
    }

    public function getDepart(): ?string
    {
        return $this->depart;
    }

    public function setDepart(?string $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(?string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }


}
