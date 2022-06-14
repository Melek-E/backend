<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientsUtil
 *
 * @ORM\Table(name="clients_util")
 * @ORM\Entity
 */
class ClientsUtil
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="clients_util_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $timetest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimetest(): ?\DateTimeInterface
    {
        return $this->timetest;
    }

    public function setTimetest(?\DateTimeInterface $timetest): self
    {
        $this->timetest = $timetest;

        return $this;
    }


}
