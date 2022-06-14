<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Assurances
 *
 * @ORM\Table(name="assurances", indexes={@ORM\Index(name="idx_2a5829cd5d172a78", columns={"numero_id"})})
 * @ORM\Entity
 */
class Assurances
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="assurances_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date_debut_contrat", type="string", length=255, nullable=true)
     */
    private $dateDebutContrat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date_fin_contrat", type="string", length=255, nullable=true)
     */
    private $dateFinContrat;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="numero_id", referencedColumnName="id")
     * })
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="nom_assurance")
     */
    private $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateDebutContrat(): ?string
    {
        return $this->dateDebutContrat;
    }

    public function setDateDebutContrat(?string $dateDebutContrat): self
    {
        $this->dateDebutContrat = $dateDebutContrat;

        return $this;
    }

    public function getDateFinContrat(): ?string
    {
        return $this->dateFinContrat;
    }

    public function setDateFinContrat(?string $dateFinContrat): self
    {
        $this->dateFinContrat = $dateFinContrat;

        return $this;
    }

    public function getNumero(): ?Client
    {
        return $this->numero;
    }

    public function setNumero(?Client $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setNomAssurance($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getNomAssurance() === $this) {
                $client->setNomAssurance(null);
            }
        }

        return $this;
    }


}
