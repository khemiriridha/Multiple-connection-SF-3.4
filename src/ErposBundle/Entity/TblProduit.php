<?php

namespace ErposBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblProduit
 *
 * @ORM\Table(name="tbl_produit")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
 
class TblProduit
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
     * @ORM\Column(name="desc_offre", type="string", length=1000, nullable=true)
     */
    private $descOffre;

    /**
     * @var int
     *
     * @ORM\Column(name="qte", type="integer",nullable=true)
     */
    private $qte;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre", type="integer",nullable=true)
     */
    private $nombre;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float",nullable=true)
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="id_utilisateur", type="integer",nullable=true)
     */
    private $idUtilisateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime")
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255,nullable=true)
     */
    private $color;
    
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string",length=255, nullable=true)
     */
    private $image;

   
    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer",nullable=true)
     */
    private $status;
	
	/**
    * @var TblFamille $famille_id
    *
    * @ORM\ManyToOne(targetEntity="ErposBundle\Entity\TblFamille", inversedBy="famille")
	* @ORM\JoinColumn(name="famille_id", referencedColumnName="id")
    */

    
    private $famille_id;

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
    * set TblFamille
    * @param TblFamille $famille_id
    */
    public function setFamilleId(TblFamille $famille_id)
    {
        $this->famille_id = $famille_id;
    }
     
    /**
    * getTblFamille
    * @return TblFamille $famille_id
    */
    public function getFamilleId()
    {
        return $this->famille_id;
    }
	 
    
    /**
     * Set descOffre
     *
     * @param string $descOffre
     *
     */
    public function setDescOffre($descOffre)
    {
        $this->descOffre = $descOffre;

        return $this;
    }

    /**
     * Get descOffre
     *
     * @return string
     */
    public function getDescOffre()
    {
        return $this->descOffre;
    }

    /**
     * Set qte
     *
     * @param integer $qte
     *
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return int
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * Set nombre
     *
     * @param integer $nombre
     *
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return int
     */
    public function getNombre()
    {
        return $this->nombre;
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
     * Set idUtilisateur
     *
     * @param integer $idUtilisateur
     *
     * @return tbl_produit
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Get idUtilisateur
     *
     * @return int
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
	* @ORM\PrePersist
	*/
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = new \DateTime();


    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     */
    public function setstatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getstatus()
    {
        return $this->status;
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
	
}

