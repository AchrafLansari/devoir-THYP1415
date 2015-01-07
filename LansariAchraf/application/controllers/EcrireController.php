<?php

class EcrireController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->Absence = new Model_DbTable_Flux_Absence();
        $this->Absence->insert(array("date"=>new Zend_Db_Expr('NOW()'),"nom_absent"=>"lansari,masseix"));
        $this->_redirect('/lire/');
    }
    
    public function sauveabsenceAction() {
        
		$this->db = new  Model_DbTable_Flux_Absence();
		//$this->dbpresence = new  Model_DbTable_Flux_presence();
                     
				if($_POST)
				{
				/* VALUES */
				$date= date('Y-m-d H:i:s');
				$nom_absent=$_POST['nom_absent'];
				//$nom_present=$_POST['nom_present'];
                                
                                $this->db->insert(array("date"=>$date,"nom_absent"=>$nom_absent));
                                //$tab_present = $this->dbpresence->tokenization($nom_present,",",0,1);
                                //$this->dbpresence->insert(array("date"=>$date,"nom_present"=>$nom_present,"id_etudiant"=>'15'));
                                
                               // }
                                } else { 
 
						header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
						exit();
				}
                    
    }
    
    public function sauvepresenceAction() {
        
		
		$this->dbpresence = new  Model_DbTable_Flux_presence();
                     
				if($_POST)
				{
				/* VALUES */
				$date= date('Y-m-d H:i:s');
				
				$nom_present=$_POST['nom_present'];
                                
                                //$this->db->insert(array("date"=>$date,"nom_absent"=>$nom_absent));
                                //$tab_present = $this->dbpresence->tokenization($nom_present,",",0,1);
                                $this->dbpresence->insert(array("date"=>$date,"nom_present"=>$nom_present,"id_etudiant"=>'16'));
                                
                               // }
                                } else { 
 
						header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
						exit();
				}
                    
    }


}

