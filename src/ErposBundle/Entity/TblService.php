<?php

namespace ErposBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * TblAdmin
 *
 * @ORM\Table(name="tbl_service")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class TblService 
{
	/**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     private $id;
	 
	 /**
     * @var string
     *
     * @ORM\Column(name="nom_service", type="string", length=255, nullable=false)
     */
    private $nom_service;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="date_saisie", type="datetime", nullable=true)
     */
	 
    private $date_saisie;
	
	 /**
     * @var integer
     *
     * @ORM\Column(name="user_saisie", type="integer", nullable=true)
     */
    private $user_saisie;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modif", type="datetime", nullable=true)
     */
	 
    private $date_modif;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="user_modif", type="integer", nullable=true)
     */
	 
    private $user_modif;
	
	/**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", nullable=true)
     */
	 
    private $commentaire;
	
    /**
    * @var TblUser $user
    * @ORM\OneToMany(targetEntity="ErposBundle\Entity\TblUser", mappedBy="service")
    */
	
    private $user;
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNomService()
    {
        return $this->nom_service;
    }

    /**
     * @param string $nom_service
     */
    public function setNomService($nom_service)
    {
        $this->nom_service = $nom_service;
    }

    /**
     * @return \DateTime
     */
    public function getDateSaisie()
    {
        return $this->date_saisie;
    }

    /**
	* @ORM\PrePersist
	*/
    public function setDateSaisie()
    {
        $this->date_saisie = new \DateTime();
    }

    /**
     * @return int
     */
    public function getUserSaisie()
    {
        return $this->user_saisie;
    }

    /**
     * @param int $user_saisie
     */
    public function setUserSaisie($user_saisie)
    {
        $this->user_saisie = $user_saisie;
    }

    /**
     * @return \DateTime
     */
    public function getDateModif()
    {
        return $this->date_modif;
    }

    /** 
	* @ORM\PreUpdate 
	*/
    public function setDateModif($date_modif)
    {
        $this->date_modif = new \DateTime();
    }

    /**
     * @return int
     */
    public function getUserModif()
    {
        return $this->user_modif;
    }

    /**
     * @param int $user_modif
     */
    public function setUserModif($user_modif)
    {
        $this->user_modif = $user_modif;
    }

    /**
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param string $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }
	
	/**
    * setUser
    *
    * @param TblUser $user
    */
    public function setUser(TblUser $user)
    {
        $this->user[] = $user;
    }
     
    /**
    * getUser
    *
    * @return array $user
    */
    public function getUser()
    {
        return $this->user;
    }


}

