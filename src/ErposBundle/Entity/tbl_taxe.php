<?php

namespace ErposBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * tbl_taxe
 *
 * @ORM\Table(name="tbl_taxe")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="ErposBundle\Repository\tbl_taxeRepository")
 */
class tbl_taxe
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="inclure", type="string", length=255)
     */
    private $inclure;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur", type="float", precision=10, scale=0)
     */
    private $valeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajoute", type="datetime", nullable=true)
     */
    private $dateAjoute;


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
     * @return tbl_taxe
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
     * Set type
     *
     * @param string $type
     *
     * @return tbl_taxe
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set inclure
     *
     * @param string $inclure
     *
     * @return tbl_taxe
     */
    public function setInclure($inclure)
    {
        $this->inclure = $inclure;

        return $this;
    }

    /**
     * Get inclure
     *
     * @return string
     */
    public function getInclure()
    {
        return $this->inclure;
    }

    /**
     * Set valeur
     *
     * @param string $valeur
     *
     * @return tbl_taxe
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set dateAjoute
     *
     * @param \DateTime $dateAjoute
     *
     * @return tbl_taxe
     */
    public function setDateAjoute($dateAjoute)
    {
        $this->dateAjoute = $dateAjoute;

        return $this;
    }

    /**
     * Get dateAjoute
     *
     * @return \DateTime
	 * @ORM\PrePersist
     */
    public function getDateAjoute()
    {
        return $this->dateAjoute = new \DateTime();
    }
}

