<?php

namespace ErposBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * TblModule
 *
 * @ORM\Table(name="tbl_module")
 * @ORM\Entity
 */
class TblModule
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
     * @ORM\Column(name="nom_module", type="string", length=255, nullable=false)
     */
    private $nom_module;
	
	 
	
	/**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=true)
     */
    private $active;
	
	/**
     * @var string
     *
     * @ORM\Column(name="classe", type="string", length=255, nullable=false)
     */
    private $classe;
	
	/**
     * @var string
     *
     * @ORM\Column(name="href", type="string", length=255, nullable=false)
     */
    private $href;
	 
	 
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=true)
     */
	 
    private $date_creation;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="user_creation", type="integer", nullable=true)
     */
    private $user_creation;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modification", type="datetime", nullable=true)
     */
	 
    private $date_modification;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="user_modification", type="integer", nullable=true)
     */
    private $user_modification;


    /**
     * @param int  
     */
    public function getId()
    {
		return $this->id;
     
    }

    /**
     * @return string
     */
    public function getNomModule()
    {
        return $this->nom_module;
    }

    /**
     * @param string $nom_module
     */
    public function setNomModule($nom_module)
    {
        $this->nom_module = $nom_module;
    }

    
    /**
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param int $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

   
    /**
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * @param \DateTime $date_creation
     */
    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    /**
     * @return int
     */
    public function getUserCreation()
    {
        return $this->user_creation;
    }

    /**
     * @param int $user_creation
     */
    public function setUserCreation($user_creation)
    {
        $this->user_creation = $user_creation;
    }

    /**
     * @return \DateTime
     */
    public function getDateModification()
    {
        return $this->date_modification;
    }

    /**
     * @param \DateTime $date_modification
     */
    public function setDateModification($date_modification)
    {
        $this->date_modification = $date_modification;
    }

    /**
     * @return int
     */
    public function getUserModification()
    {
        return $this->user_modification;
    }

    /**
     * @param int $user_modification
     */
    public function setUserModification($user_modification)
    {
        $this->user_modification = $user_modification;
    }
	
	 /**
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param string $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
    }
	
	/**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     */
    public function setHref($href)
    {
        $this->href = $href;
    }


}

