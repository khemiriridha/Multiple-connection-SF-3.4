<?php

namespace ErposBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * TblPermission
 *
 * @ORM\Table(name="tbl_permission")
 * @ORM\Entity
 */
class TblPermission
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
     * @var integer
     *
     * @ORM\Column(name="addpermission", type="integer",  options={"default" : 0})
     */
    private $addpermission = 0;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="supppermission", type="integer", options={"default" : 0})
     */
    private $supppermission = 0;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="editpermission", type="integer", options={"default" : 0})
     */
    private $editpermission = 0;
	

	/**
    * @var TblGroupe $groupe_id
    *
    * @ORM\ManyToOne(targetEntity="ErposBundle\Entity\TblGroupe", inversedBy="groupe_permission")
	* @ORM\JoinColumn(name="groupe_id", referencedColumnName="id")
    */
    public $groupe_id;
	
	/**
    * @var TblRubrique $rubrique_id
    *
    * @ORM\ManyToOne(targetEntity="ErposBundle\Entity\TblRubrique", inversedBy="rubrique_permission")
	* @ORM\JoinColumn(name="rubrique_id", referencedColumnName="id")
    */
    public $rubrique_id;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return integer
     */
    public function getAddPermission()
    {
        return $this->addpermission;
    }

    /**
     * @param integer $addpermission
     */
    public function setAddPermission($addpermission)
    {
        $this->addpermission = $addpermission;
    }
	
	/**
     * @return integer
     */
    public function getSuppPermission()
    {
        return $this->supppermission;
    }

    /**
     * @param integer $supppermission
     */
    public function setSuppPermission($supppermission)
    {
        $this->supppermission = $supppermission;
    }
	
	/**
     * @return integer
     */
    public function getEditPermission()
    {
        return $this->editpermission;
    }

    /**
     * @param integer $editpermission
     */
    public function setEditPermission($editpermission)
    {
        $this->editpermission = $editpermission;
    }

	
	/**
    * set TblGroupe
    * @param TblGroupe $groupe_id
    */
    public function setGroupeId(TblGroupe $groupe_id)
    {
        $this->groupe_id = $groupe_id;
    }
     
    /**
    * getTblGroupe
    * @return TblGroupe $groupe_id
    */
    public function getGroupeId()
    {
        return $this->groupe_id;
    }
	
	/**
    * set TblRubrique
    * @param TblRubrique $rubrique_id
    */
    public function setRubriqueId(TblRubrique $rubrique_id)
    {
        $this->rubrique_id = $rubrique_id;
    }
     
    /**
    * getTblRubrique
    * @return TblRubrique $rubrique_id
    */
    public function getRubriqueId()
    {
        return $this->rubrique_id;
    }


}

