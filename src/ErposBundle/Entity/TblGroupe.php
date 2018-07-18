<?php

namespace ErposBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * TblGroupe
 *
 * @ORM\Table(name="tbl_groupe")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class TblGroupe
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
     * @ORM\Column(name="nom_groupe", type="string", length=255, nullable=false)
     */
    private $nom_groupe;
	
	/**
     * @var string
     *
     * @ORM\Column(name="image_groupe", type="string", length=255, nullable=true)
     */
    private $image_groupe;
	
	 /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="confidentialite", type="integer", nullable=true)
     */
    private $confidentialite;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=true)
     */
    private $active;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="publier", type="integer", nullable=true)
     */
    private $publier;
	
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNomGroupe()
    {
        return $this->nom_groupe;
    }

    /**
     * @param string $nom_groupe
     */
    public function setNomGroupe($nom_groupe)
    {
        $this->nom_groupe = $nom_groupe;
    }

    /**
     * @return string
     */
    public function getImageGroupe()
    {
        return $this->image_groupe;
    }

    /**
     * @param string $image_groupe
     */
    public function setImageGroupe($image_groupe)
    {
        $this->image_groupe = $image_groupe;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getConfidentialite()
    {
        return $this->confidentialite;
    }

    /**
     * @param int $confidentialite
     */
    public function setConfidentialite($confidentialite)
    {
        $this->confidentialite = $confidentialite;
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
     * @return int
     */
    public function getPublier()
    {
        return $this->publier;
    }

    /**
     * @param int $publier
     */
    public function setPublier($publier)
    {
        $this->publier = $publier;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
	* @ORM\PrePersist
	*/
    public function setDateCreation()
    {
        $this->date_creation = new \DateTime();
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
	* @ORM\PreUpdate 
	*/
    public function setDateModification($date_modification)
    {
        $this->date_modification = new \DateTime();
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


}

