<?php

namespace Comunidad\MensajesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Messages
 *
 * @ORM\Table(name="messages", indexes={@ORM\Index(name="IDX_DB021E966B3CA4B", columns={"id_user"})})
 * @ORM\Entity
 */
class Messages 
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="to_user", type="integer", nullable=false)
     */
    private $toUser;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="blob", nullable=false)
     */
    private $message;


    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $title;

    /**
     * @var \Comunidad\UsuariosBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Comunidad\UsuariosBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set toUser
     *
     * @param integer $toUser
     * @return Messages
     */
    public function setToUser($toUser)
    {
        $this->toUser = $toUser;

        return $this;
    }

    /**
     * Get toUser
     *
     * @return integer 
     */
    public function getToUser()
    {
        return $this->toUser;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Messages
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }


    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Set title
     *
     * @param string $message
     * @return Title
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }


    /**
     * Set idUser
     *
     * @param \Comunidad\UsuariosBundle\Entity\Users $idUser
     * @return Messages
     */
    public function setIdUser(\Comunidad\UsuariosBundle\Entity\Users $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \Comunidad\MensajesBundle\Entity\Users 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}
