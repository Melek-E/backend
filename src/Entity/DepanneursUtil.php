<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DepanneursUtil
 *
 * @ORM\Table(name="depanneurs_util")
 * @ORM\Entity
 */
class DepanneursUtil
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="depanneurs_util_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }


}
