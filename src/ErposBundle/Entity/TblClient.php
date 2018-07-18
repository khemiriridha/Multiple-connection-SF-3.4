<?php

namespace ErposBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblClient
 *
 * @ORM\Table(name="tbl_client")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class TblClient
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
     * @ORM\Column(name="RS", type="string", length=255)
     */
    private $rS;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string", length=255)
     */
    private $siret;

    /**
     * @var string
     *
     * @ORM\Column(name="account", type="string", length=255,nullable=true)
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255, nullable=true)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=255, nullable=false)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="numtel", type="string", length=255, nullable=true)
     */
    private $numtel;

    /**
     * @var string
     *
     * @ORM\Column(name="numtel_voip", type="string", length=255, nullable=true)
     */
    private $numtelVoip;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime")
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="activer", type="string", length=255, nullable=true)
     */
    private $activer;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_societe", type="string", length=255, nullable=true)
     */
    private $nomSociete;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_commercial", type="string", length=255, nullable=true)
     */
    private $nomCommercial;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=255, nullable=true)
     */
    private $fonction;

    /**
     * @var string
     *
     * @ORM\Column(name="commercial", type="string", length=255, nullable=true)
     */
    private $commercial;

    /**
     * @var string
     *
     * @ORM\Column(name="type_client", type="string", length=255, nullable=true)
     */
    private $type_client;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string", length=255, nullable=true)
     */
    private $specialite;

    /**
     * @var string
     *
     * @ORM\Column(name="valid", type="string", length=255, nullable=true)
     */
    private $valid;

    /**
     * @var string
     *
     * @ORM\Column(name="fich", type="string", length=255, nullable=true)
     */
    private $fich;

    /**
     * @var string
     *
     * @ORM\Column(name="type_activite", type="string", length=255, nullable=true)
     */
    private $typeActivite;

    /**
     * @var string
     *
     * @ORM\Column(name="rcs", type="string", length=255, nullable=true)
     */
    private $rcs;

    /**
     * @var string
     *
     * @ORM\Column(name="note_technique", type="string", length=255, nullable=true)
     */
    private $noteTechnique;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

    /**
     * @var int
     *
     * @ORM\Column(name="etat_supp", type="integer", nullable=true)
     */
    private $etatSupp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_supp", type="datetime", nullable=true)
     */
    private $dateSupp;

    /**
     * @var int
     *
     * @ORM\Column(name="user_supp", type="integer", nullable=true)
     */
    private $userSupp;

    /**
     * @var int
     *
     * @ORM\Column(name="id_utilisateur", type="integer", nullable=true)
     */
    private $idUtilisateur;


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
     * Set rS
     *
     * @param string $rS
     *
     * @return tbl_client
     */
    public function setRS($rS)
    {
        $this->rS = $rS;

        return $this;
    }

    /**
     * Get rS
     *
     * @return string
     */
    public function getRS()
    {
        return $this->rS;
    }

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return tbl_client
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set account
     *
     * @param string $account
     *
     * @return tbl_client
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return tbl_client
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return tbl_client
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return tbl_client
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return tbl_client
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return tbl_client
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return tbl_client
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return tbl_client
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     *
     * @return tbl_client
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set numtel
     *
     * @param string $numtel
     *
     * @return tbl_client
     */
    public function setNumtel($numtel)
    {
        $this->numtel = $numtel;

        return $this;
    }

    /**
     * Get numtel
     *
     * @return string
     */
    public function getNumtel()
    {
        return $this->numtel;
    }

    /**
     * Set numtelVoip
     *
     * @param string $numtelVoip
     *
     * @return tbl_client
     */
    public function setNumtelVoip($numtelVoip)
    {
        $this->numtelVoip = $numtelVoip;

        return $this;
    }

    /**
     * Get numtelVoip
     *
     * @return string
     */
    public function getNumtelVoip()
    {
        return $this->numtelVoip;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return tbl_client
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return tbl_client
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
     * Set activer
     *
     * @param string $activer
     *
     * @return tbl_client
     */
    public function setActiver($activer)
    {
        $this->activer = $activer;

        return $this;
    }

    /**
     * Get activer
     *
     * @return string
     */
    public function getActiver()
    {
        return $this->activer;
    }

    /**
     * Set nomSociete
     *
     * @param string $nomSociete
     *
     * @return tbl_client
     */
    public function setNomSociete($nomSociete)
    {
        $this->nomSociete = $nomSociete;

        return $this;
    }

    /**
     * Get nomSociete
     *
     * @return string
     */
    public function getNomSociete()
    {
        return $this->nomSociete;
    }

    /**
     * Set nomCommercial
     *
     * @param string $nomCommercial
     *
     * @return tbl_client
     */
    public function setNomCommercial($nomCommercial)
    {
        $this->nomCommercial = $nomCommercial;

        return $this;
    }

    /**
     * Get nomCommercial
     *
     * @return string
     */
    public function getNomCommercial()
    {
        return $this->nomCommercial;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     *
     * @return tbl_client
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set commercial
     *
     * @param string $commercial
     *
     * @return tbl_client
     */
    public function setCommercial($commercial)
    {
        $this->commercial = $commercial;

        return $this;
    }

    /**
     * Get commercial
     *
     * @return string
     */
    public function getCommercial()
    {
        return $this->commercial;
    }

    /**
     * Set type
     *
     * @param string $type_client
     *
     * @return tbl_client
     */
    public function setType_client($type_client)
    {
        $this->type_client = $type_client;

        return $this;
    }

    /**
     * Get type_client
     *
     * @return string
     */
    public function getTypeClient()
    {
        return $this->type_client;
    }

    /**
     * Set specialite
     *
     * @param string $specialite
     *
     * @return tbl_client
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get specialite
     *
     * @return string
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set valid
     *
     * @param string $valid
     *
     * @return tbl_client
     */
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * Get valid
     *
     * @return string
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * Set fich
     *
     * @param string $fich
     *
     * @return tbl_client
     */
    public function setFich($fich)
    {
        $this->fich = $fich;

        return $this;
    }

    /**
     * Get fich
     *
     * @return string
     */
    public function getFich()
    {
        return $this->fich;
    }

    /**
     * Set typeActivite
     *
     * @param string $typeActivite
     *
     * @return tbl_client
     */
    public function setTypeActivite($typeActivite)
    {
        $this->typeActivite = $typeActivite;

        return $this;
    }

    /**
     * Get typeActivite
     *
     * @return string
     */
    public function getTypeActivite()
    {
        return $this->typeActivite;
    }

    /**
     * Set rcs
     *
     * @param string $rcs
     *
     * @return tbl_client
     */
    public function setRcs($rcs)
    {
        $this->rcs = $rcs;

        return $this;
    }

    /**
     * Get rcs
     *
     * @return string
     */
    public function getRcs()
    {
        return $this->rcs;
    }

    /**
     * Set noteTechnique
     *
     * @param string $noteTechnique
     *
     * @return tbl_client
     */
    public function setNoteTechnique($noteTechnique)
    {
        $this->noteTechnique = $noteTechnique;

        return $this;
    }

    /**
     * Get noteTechnique
     *
     * @return string
     */
    public function getNoteTechnique()
    {
        return $this->noteTechnique;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     *
     * @return tbl_client
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set etatSupp
     *
     * @param integer $etatSupp
     *
     * @return tbl_client
     */
    public function setEtatSupp($etatSupp)
    {
        $this->etatSupp = $etatSupp;

        return $this;
    }

    /**
     * Get etatSupp
     *
     * @return int
     */
    public function getEtatSupp()
    {
        return $this->etatSupp;
    }

    /**
     * Set dateSupp
     *
     * @param \DateTime $dateSupp
     *
     * @return tbl_client
     */
    public function setDateSupp($dateSupp)
    {
        $this->dateSupp = $dateSupp;

        return $this;
    }

    /**
     * Get dateSupp
     *
     * @return \DateTime
     */
    public function getDateSupp()
    {
        return $this->dateSupp;
    }

    /**
     * Set userSupp
     *
     * @param integer $userSupp
     *
     * @return tbl_client
     */
    public function setUserSupp($userSupp)
    {
        $this->userSupp = $userSupp;

        return $this;
    }

    /**
     * Get userSupp
     *
     * @return int
     */
    public function getUserSupp()
    {
        return $this->userSupp;
    }

    /**
     * Set idUtilisateur
     *
     * @param integer $idUtilisateur
     *
     * @return tbl_client
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
}

