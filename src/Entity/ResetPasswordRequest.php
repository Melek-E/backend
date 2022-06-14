<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResetPasswordRequest
 *
 * @ORM\Table(name="reset_password_request", indexes={@ORM\Index(name="idx_7ce748aa76ed395", columns={"user_id"})})
 * @ORM\Entity
 */
class ResetPasswordRequest
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="reset_password_request_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}
