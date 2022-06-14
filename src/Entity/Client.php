<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client", indexes={@ORM\Index(name="idx_c744045538261e2", columns={"client_assurance_id"})})
 * @ORM\Entity
 */
class Client
{
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="client_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $num_telephone;

   
    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;
   
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre_voitures", type="string", length=255, nullable=true)
     */
    private $nombreVoitures;

    

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=true)
     */
    
    private $etat;

     /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @var \Assurances
     *
     * @ORM\ManyToOne(targetEntity="Assurances")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_assurance_id", referencedColumnName="id")
     * })
     */
    private $clientAssurance;

   
    /**
     * @ORM\ManyToOne(targetEntity=Assurances::class, inversedBy="clients")
     */
    private $nom_assurance;

    /**
     * @ORM\OneToMany(targetEntity=Voiture::class, mappedBy="client_nom")
     */
    private $voiture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timed;

    /**
     * @ORM\OneToOne(targetEntity=Demande::class, mappedBy="id_client", cascade={"persist", "remove"})
     */
    private $demande;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="user_client", cascade={"persist", "remove"})
     */
    private $relationship;

   
    









    
    public function __construct()
    {
        $this->voiture = new ArrayCollection();
        $this->timed = new \DateTime();
    }

  

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
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

   
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNombreVoitures(): ?string
    {
        return $this->nombreVoitures;
    }

    public function setNombreVoitures(?string $nombreVoitures): self
    {
        $this->nombreVoitures = $nombreVoitures;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getClientAssurance(): ?Assurances
    {
        return $this->clientAssurance;
    }

    public function setClientAssurance(?Assurances $clientAssurance): self
    {
        $this->clientAssurance = $clientAssurance;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNomAssurance(): ?assurances
    {
        return $this->nom_assurance;
    }

    public function setNomAssurance(?assurances $nom_assurance): self
    {
        $this->nom_assurance = $nom_assurance;

        return $this;
    }

    public function getNumTelephone(): ?string
    {
        return $this->num_telephone;
    }

    public function setNumTelephone(?string $num_telephone): self
    {
        $this->num_telephone = $num_telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, voiture>
     */
    public function getVoiture(): Collection
    {
        return $this->voiture;
    }

    public function addVoiture(voiture $voiture): self
    {
        if (!$this->voiture->contains($voiture)) {
            $this->voiture[] = $voiture;
            $voiture->setClientNom($this);
        }

        return $this;
    }

    public function removeVoiture(voiture $voiture): self
    {
        if ($this->voiture->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getClientNom() === $this) {
                $voiture->setClientNom(null);
            }
        }

        return $this;
    }

    public function getTimed(): ?\DateTimeInterface
    {
        return $this->timed;
    }

    public function setTimed(\DateTimeInterface $timed): self
    {
        $this->timed = $timed;

        return $this;
    }

    public function getDemande(): ?Demande
    {
        return $this->demande;
    }

    public function setDemande(?Demande $demande): self
    {
        // unset the owning side of the relation if necessary
        if ($demande === null && $this->demande !== null) {
            $this->demande->setIdClient(null);
        }

        // set the owning side of the relation if necessary
        if ($demande !== null && $demande->getIdClient() !== $this) {
            $demande->setIdClient($this);
        }

        $this->demande = $demande;

        return $this;
    }

    public function getRelationship(): ?User
    {
        return $this->relationship;
    }

    public function setRelationship(?User $relationship): self
    {
        $this->relationship = $relationship;

        return $this;
    }


}
