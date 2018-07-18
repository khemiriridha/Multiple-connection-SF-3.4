<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblBd
 *
 * @ORM\Table(name="tbl_bd")
 * @ORM\Entity
 */
class TblBd
{
	/**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
	
	/**
    * @var TblAdmin $tblAdmin
    *
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TblAdmin", inversedBy="tblAdmin")
	* @ORM\JoinColumn(name="tblAdmin_id", nullable=false, referencedColumnName="id")
    */
   
    private $tblAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="serveur", type="string", length=255, nullable=false)
     */
    private $serveur = '';

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, nullable=false)
     */
    private $login = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bd_name", type="string", length=255, nullable=false)
     */
    private $bdName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password = '';

    /**
     * @var string
     *
     * @ORM\Column(name="serveur_bd_voip", type="string", length=255, nullable=true)
     */
    private $serveurBdVoip;

    /**
     * @var string
     *
     * @ORM\Column(name="login_voip", type="string", length=255, nullable=true)
     */
    private $loginVoip;

    /**
     * @var string
     *
     * @ORM\Column(name="bd_name_voip", type="string", length=255, nullable=true)
     */
    private $bdNameVoip;

    /**
     * @var string
     *
     * @ORM\Column(name="passowrd_voip", type="string", length=255, nullable=true)
     */
    private $passowrdVoip;

    /**
     * @var string
     *
     * @ORM\Column(name="info_clt_php", type="string", length=256, nullable=true)
     */
    private $infoCltPhp;

    

    /**
     * @return int
     */
    public function getIdClt()
    {
        return $this->idClt;
    }

    /**
     * @return string
     */
    public function getServeur()
    {
        return $this->serveur;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getBdName()
    {
        return $this->bdName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getServeurBdVoip()
    {
        return $this->serveurBdVoip;
    }

    /**
     * @return string
     */
    public function getLoginVoip()
    {
        return $this->loginVoip;
    }

    /**
     * @return string
     */
    public function getBdNameVoip()
    {
        return $this->bdNameVoip;
    }

    /**
     * @return string
     */
    public function getPassowrdVoip()
    {
        return $this->passowrdVoip;
    }

    /**
     * @return string
     */
    public function getInfoCltPhp()
    {
        return $this->infoCltPhp;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $idClt
     */
    public function setIdClt($idClt)
    {
        $this->idClt = $idClt;
    }

    /**
     * @param string $serveur
     */
    public function setServeur($serveur)
    {
        $this->serveur = $serveur;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param string $bdName
     */
    public function setBdName($bdName)
    {
        $this->bdName = $bdName;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param string $serveurBdVoip
     */
    public function setServeurBdVoip($serveurBdVoip)
    {
        $this->serveurBdVoip = $serveurBdVoip;
    }

    /**
     * @param string $loginVoip
     */
    public function setLoginVoip($loginVoip)
    {
        $this->loginVoip = $loginVoip;
    }

    /**
     * @param string $bdNameVoip
     */
    public function setBdNameVoip($bdNameVoip)
    {
        $this->bdNameVoip = $bdNameVoip;
    }

    /**
     * @param string $passowrdVoip
     */
    public function setPassowrdVoip($passowrdVoip)
    {
        $this->passowrdVoip = $passowrdVoip;
    }

    /**
     * @param string $infoCltPhp
     */
    public function setInfoCltPhp($infoCltPhp)
    {
        $this->infoCltPhp = $infoCltPhp;
    }

    /**
    * set TblAdmin
    * @param TblAdmin $tblAdmin
    */
    public function setTblAdmin(TblAdmin $tblAdmin)
    {
        $this->tblAdmin = $tblAdmin;
    }
     
    /**
    * getTblAdmin
    * @return TblAdmin $TblAdmin
    */
    public function getTblAdmin()
    {
        return $this->tblAdmin;
    }


}

