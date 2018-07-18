<?php
 
namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;

 
/**
 * namespace AppBundle\Entity; 
 * @ORM\Table(name="article")
 * @ORM\Entity
 */
class Article
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
 
    /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;
 
    /**
     * @var string $contenu
     *
     * @ORM\Column(name="contenu", type="string")
     */
    private $contenu;
 
    /**
     * @var date $dateAjout
     *
     * @ORM\Column(name="dateAjout", type="date")
     */
    private $dateAjout;
     
    /**
    * @var Commentaire $commentaires
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Commentaire", mappedBy="article")
    */
    private $commentaires;
     
    public function __construct()
    {
        $this->dateAjout = new \DateTime('now');
    }
 
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
     * Set titre
     *
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
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
     * Set contenu
     *
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }
 
    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
 
    /**
     * Set dateAjout
     *
     * @param date $dateAjout
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }
 
    /**
     * Get dateAjout
     *
     * @return date
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }
     
    /**
    * setCommentaire
    *
    * @param Commentaire $commentaire
    */
    public function setCommentaire(Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;
    }
     
    /**
    * getCommentaires
    *
    * @return array $commentaires
    */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
}