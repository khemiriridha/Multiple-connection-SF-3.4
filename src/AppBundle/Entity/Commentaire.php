<?php
 
namespace AppBundle\Entity;
 

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection; 
/**
 * AppBundle\Entity\Commentaire
 * @ORM\Table(name="commentaire")
 * @ORM\Entity
 */
class Commentaire
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
     * @var string $message
     *
     * @ORM\Column(name="message", type="string")
     */
    private $message;
 
    /**
     * @var datetime $dateAjout
     *
     * @ORM\Column(name="dateAjout", type="datetime")
     */
    private $dateAjout;
 
    /**
    * @var Article $article
    *
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article", inversedBy="commentaires")
    */
    public $article;
     
    public function __construct()
    {
        //$this->article = new ArrayCollection();
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
     * Set message
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
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
     * Set dateAjout
     *
     * @param datetime $dateAjout
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;
    }
 
    /**
     * Get dateAjout
     *
     * @return datetime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }
     
    /**
    * set Article
    * @param Article $article
    */
    public function setArticle(Article $article)
    {
        $this->article = $article;
    }
     
    /**
    * getArticle
    * @return Article $article
    */
    public function getArticle()
    {
        return $this->article;
    }
}