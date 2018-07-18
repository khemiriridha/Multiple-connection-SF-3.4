<?php

namespace ErposBundle\Permission;

class Permission
{

    private $addpermission;
	
	 
    private $supppermission;
	
 
    private $editpermission;
	
	public function __construct()
    {
        $this->addpermission	=	"1";
		$this->editpermission	=	"1";
		$this->supppermission	=	"1";
    }

	 

    
 
    public function getAddPermission()
    {
        return $this->addpermission;
    }

     
	
	 
    public function getSuppPermission()
    {
        return $this->supppermission;
    }

 
    public function getEditPermission()
    {
        return $this->editpermission;
    }

   

	
	 

}

