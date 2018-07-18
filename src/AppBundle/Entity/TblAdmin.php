<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TblAdmin
 *
 * @ORM\Table(name="tbl_admin")
 * @ORM\Entity
 */
class TblAdmin implements UserInterface, \Serializable
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
     * @ORM\Column(name="level", type="integer", nullable=true)
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
     * @ORM\Column(name="num_tel", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="email", type="text", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=255, nullable=true)
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
     * @var integer
     *
     * @ORM\Column(name="id_service", type="integer", nullable=true)
     */
    private $idService;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
	
	 /**
     * @var string
     *
     * @ORM\Column(name="rs", type="string", length=255, nullable=true)
     */
    private $rs = '';

    /**
     * @var string
     *
     * @ORM\Column(name="siren", type="string", length=255, nullable=true)
     */
    private $siren;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255, nullable=true)
     */
    private $siret = '';

    /**
     * @var string
     *
     * @ORM\Column(name="n_tva_intracommunautaire", type="string", length=255, nullable=true)
     */
    private $nTvaIntracommunautaire;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=512, nullable=true)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_activite", type="string", length=512, nullable=true)
     */
    private $descActivite;

    /**
     * @var string
     *
     * @ORM\Column(name="forme_juridique", type="string", length=512, nullable=true)
     */
    private $formeJuridique;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_immatriculation_rcs", type="date", nullable=true)
     */
    private $dateImmatriculationRcs;

    /**
     * @var string
     *
     * @ORM\Column(name="tranche_effectif", type="string", length=512, nullable=true)
     */
    private $trancheEffectif;

    /**
     * @var string
     *
     * @ORM\Column(name="capital_social", type="string", length=512, nullable=true)
     */
    private $capitalSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="rcs", type="string", length=255, nullable=true)
     */
    private $rcs = '';

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse = '';

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=32, nullable=true)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, nullable=true)
     */
    private $pays = 'France';

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=250, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="port", type="string", length=250, nullable=true)
     */
    private $port;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=250, nullable=true)
     */
    private $fax;

    

    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=512, nullable=true)
     */
    private $site;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom = '';

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom = '';

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="text", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_client", type="integer", nullable=true)
     */
    private $id_client;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="id_user", type="integer", nullable=true)
     */
    private $id_user;

   

    /**
     * @var integer
     *
     * @ORM\Column(name="grp_clt", type="integer", nullable=true)
     */
    private $grpClt;
	
	/**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    public $status;
 
	/**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TblBd", mappedBy="tblBd")
     */
	private $tblBd; 
	
	public function __construct()
    {
		$this->tblBd = new ArrayCollection();
        //$this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
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
     * @param int $idService
     */
    public function setIdService($idService)
    {
        $this->idService = $idService;
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
	
	// public function getRoles()
    // {
        // return array('ROLE_USER');
    // }
	
	public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
	public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
	
	public function getRoles()
	{
		 return array(
            'ROLE_USER', // normal "string" role
			'ROLE_'.$this->getStatus(),
            // ...,
            //new UserDependentRole($this), // dynamic role
        );
	}

	 /**
     * @return string
     */
    public function getRs()
    {
        return $this->rs;
    }

    /**
     * @return string
     */
    public function getSiren()
    {
        return $this->siren;
    }

    /**
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * @return string
     */
    public function getNTvaIntracommunautaire()
    {
        return $this->nTvaIntracommunautaire;
    }

    /**
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @return string
     */
    public function getDescActivite()
    {
        return $this->descActivite;
    }

    /**
     * @return string
     */
    public function getFormeJuridique()
    {
        return $this->formeJuridique;
    }

    /**
     * @return \DateTime
     */
    public function getDateImmatriculationRcs()
    {
        return $this->dateImmatriculationRcs;
    }

    /**
     * @return string
     */
    public function getTrancheEffectif()
    {
        return $this->trancheEffectif;
    }

    /**
     * @return string
     */
    public function getCapitalSocial()
    {
        return $this->capitalSocial;
    }

    /**
     * @return string
     */
    public function getRcs()
    {
        return $this->rcs;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    

    /**
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @return int
     */
    public function getVoip()
    {
        return $this->voip;
    }

  

    /**
     * @return int
     */
    public function getGrpClt()
    {
        return $this->grpClt;
    }

   

    /**
     * @param string $rs
     */
    public function setRs($rs)
    {
        $this->rs = $rs;
    }

    /**
     * @param string $siren
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;
    }

    /**
     * @param string $siret
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    }

    /**
     * @param string $nTvaIntracommunautaire
     */
    public function setNTvaIntracommunautaire($nTvaIntracommunautaire)
    {
        $this->nTvaIntracommunautaire = $nTvaIntracommunautaire;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @param string $descActivite
     */
    public function setDescActivite($descActivite)
    {
        $this->descActivite = $descActivite;
    }

    /**
     * @param string $formeJuridique
     */
    public function setFormeJuridique($formeJuridique)
    {
        $this->formeJuridique = $formeJuridique;
    }

    /**
     * @param \DateTime $dateImmatriculationRcs
     */
    public function setDateImmatriculationRcs($dateImmatriculationRcs)
    {
        $this->dateImmatriculationRcs = $dateImmatriculationRcs;
    }

    /**
     * @param string $trancheEffectif
     */
    public function setTrancheEffectif($trancheEffectif)
    {
        $this->trancheEffectif = $trancheEffectif;
    }

    /**
     * @param string $capitalSocial
     */
    public function setCapitalSocial($capitalSocial)
    {
        $this->capitalSocial = $capitalSocial;
    }

    /**
     * @param string $rcs
     */
    public function setRcs($rcs)
    {
        $this->rcs = $rcs;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @param string $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * @param string $pays
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    }

    /**
     * @param string $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @param string $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }


    /**
     * @param string $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @param string $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }
	
    /**
     * @param string $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }
	/**
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    /**
     * @param int $grpClt
     */
    public function setGrpClt($grpClt)
    {
        $this->grpClt = $grpClt;
    }
	
	/**
	 * @return ArrayCollection $tblBd
     */
    public function getTblBd() {
        return $this->tblBd;
    }
 
    /**
     * @return int
     */
    public function getIdClient()
    {
        return $this->id_client;
    }
	 /**
     * @param integer $id_client
     */
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }
	
	/**
     * @return int
     */
    public function getIdUser()
    {
        return $this->id_user;
    }
	 /**
     * @param integer $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }
     
}

