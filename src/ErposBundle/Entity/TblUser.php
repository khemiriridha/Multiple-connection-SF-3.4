<?php

namespace ErposBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * TblUser
 *
 * @ORM\Table(name="tbl_user")
 * @ORM\Entity
 */
class TblUser 
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
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=1000, nullable=false)
     */
    public $password ;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dernier_act", type="datetime", nullable=true)
     */
    private $dernierAct;

    /**
     * @var string
     *
     * @ORM\Column(name="num_tel", type="string", length=255, nullable=false)
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="service", type="string", length=225, nullable=true)
     */
    private $service;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="text", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=255, nullable=false)
     */
    private $mobile;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_equipe", type="integer", nullable=true)
     */
    private $idEquipe;

    /**
     * @var integer
     *
     * @ORM\Column(name="pointage", type="integer", nullable=true)
     */
    private $pointage;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="id_clt", type="integer", nullable=true)
     */
    private $id_clt;
     

    /**
     * @var integer
     *
     * @ORM\Column(name="voip", type="integer", nullable=true)
     */
    private $voip = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="voip_provider", type="string", length=255, nullable=true)
     */
    private $voipProvider;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_complet", type="string", length=1024, nullable=true)
     */
    private $nomComplet;


    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="text", length=65535, nullable=true)
     */
    private $photo;


	/**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    public $status;
	
 
 
    /**
    * @var TblService $service_id
    *
    * @ORM\ManyToOne(targetEntity="ErposBundle\Entity\TblService", inversedBy="user")
	* @ORM\JoinColumn(name="service_id", referencedColumnName="id")
    */
    public $service_id;
	
	public function __construct()
    {
 
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return \DateTime
     */
    public function getDernierAct()
    {
        return $this->dernierAct;
    }

    /**
     * @return numTel
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @return int
     */
    public function getIdEquipe()
    {
        return $this->idEquipe;
    }

    /**
     * @return int
     */
    public function getPointage()
    {
        return $this->pointage;
    }

    /**
     * @return int
     */
    public function getIdclient()
    {
        return $this->id_clt;
    }
	
    /**
     * @return string
     */
    public function getVoip()
    {
        return $this->voip;
    }

    /**
     * @return string
     */
    public function getVoipProvider()
    {
        return $this->voipProvider;
    }

    /**
     * @return string
     */
    public function getNomComplet()
    {
        return $this->nomComplet;
    }

    /**
     * @return int
     */
    public function getIdService()
    {
        return $this->idService;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @param \DateTime $dernierAct
     */
    public function setDernierAct($dernierAct)
    {
        $this->dernierAct = $dernierAct;
    }

    /**
     * @param string $numTel
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;
    }

    /**
     * @param string $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @param int $idEquipe
     */
    public function setIdEquipe($idEquipe)
    {
        $this->idEquipe = $idEquipe;
    }

    /**
     * @param int $pointage
     */
    public function setPointage($pointage)
    {
        $this->pointage = $pointage;
    }
    /**
     * @param int $id_clt
     */
    public function setIdclient($id_clt)
    {
        $this->id_clt = $id_clt;
    }
   
    /**
     * @param int $voip
     */
    public function setVoip($voip)
    {
        $this->voip = $voip;
    }

    /**
     * @param string $voipProvider
     */
    public function setVoipProvider($voipProvider)
    {
        $this->voipProvider = $voipProvider;
    }

    /**
     * @param string $nomComplet
     */
    public function setNomComplet($nomComplet)
    {
        $this->nomComplet = $nomComplet;
    }

     
	/**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
	
	/**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
	
	/**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
	
	/**
    * set TblService
    * @param TblService $service_id
    */
    public function setServiceId(TblService $service_id)
    {
        $this->service_id = $service_id;
    }
     
    /**
    * getTblService
    * @return TblService $service_id
    */
    public function getServiceId()
    {
        return $this->service_id;
    }
	
 
	 
 

    

     
 
	

     
}

