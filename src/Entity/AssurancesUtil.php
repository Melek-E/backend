<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AssurancesUtil
 *
 * @ORM\Table(name="assurances_util", indexes={@ORM\Index(name="idx_4238bd4667b3b43d", columns={"users_id"})})
 * @ORM\Entity
 */
class AssurancesUtil
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="assurances_util_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     * })
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?Client
    {
        return $this->users;
    }

    public function setUsers(?Client $users): self
    {
        $this->users = $users;

        return $this;
    }


}
