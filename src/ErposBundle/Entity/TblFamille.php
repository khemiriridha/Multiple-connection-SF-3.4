<?php

namespace ErposBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblFamille
 * @ORM\Table(name="tbl_famille")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class TblFamille
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="detail_famille", type="string", length=255, nullable=true)
     */
    private $detailFamille;

    /**
     * @var string
     *
     * @ORM\Column(name="type_famille", type="string", length=255, nullable=true)
     */
    private $type_famille;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", nullable=true)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string",length=255, nullable=true)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_utilisateur", type="integer", nullable=true)
     */
    private $id_utilisateur;
    
	/**
	 * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime")
     */
    private $date_ajout;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return TblFamille
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set detailFamille
     *
     * @param string $detailFamille
     *
     */
    public function setDetailFamille($detailFamille)
    {
        $this->detailFamille = $detailFamille;

        return $this;
    }

    /**
     * Get detailFamille
     *
     * @return string
     */
    public function getDetailFamille()
    {
        return $this->detailFamille;
    }

    /**
     * Set type_famille
     *
     * @param string $type_famille
     *
     */
    public function setTypeFamille($type_famille)
    {
        $this->type_famille = $type_famille;

        return $this;
    }

    /**
     * Get type_famille
     *
     * @return string
     */
    public function getTypeFamille()
    {
        return $this->type_famille;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
	
    /**
     * Set id_utilisateur
     *
     * @param integer $id_utilisateur
     *
     */
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    /**
     * Get id_utilisateur
     *
     * @return integer
     */
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }
	
    /**
	* @ORM\PrePersist
	*/
    public function setDateAjout($date_ajout)
    {
        $this->date_ajout = new \DateTime();


    }

	/**
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->date_ajout;
    }
	
	
	
}

