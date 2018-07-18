<?php

namespace ErposBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * TblGroupeUser
 *
 * @ORM\Table(name="tbl_groupe_user")
 * @ORM\Entity
 */
class TblGroupeUser 
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
    * @var TblGroupe $groupe_id
    *
    * @ORM\ManyToOne(targetEntity="ErposBundle\Entity\TblGroupe", inversedBy="groupe_user")
	* @ORM\JoinColumn(name="groupe_id", referencedColumnName="id")
    */
    public $groupe_id;
	
	/**
    * @var TblUser $user_id
    *
    * @ORM\ManyToOne(targetEntity="ErposBundle\Entity\TblUser", inversedBy="user")
	* @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    public $user_id;
	
	/**
    * set TblUser
    * @param TblUser $user_id
    */
    public function setUserId(TblUser $user_id)
    {
        $this->user_id = $user_id;
    }
     
    /**
    * getTblUser
    * @return TblUser $user_id
    */
    public function getUserId()
    {
        return $this->user_id;
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
	
	
	
	


}

