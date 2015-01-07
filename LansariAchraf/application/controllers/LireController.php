<?php

class LireController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->Absence = new Model_DbTable_Flux_Absence();
        $tab = $this->Absence->get(null,10,0);
        //var_dump($tab);
        echo 'Absence :';
        foreach ($tab as $items) {
            
            echo $items["date"].'<br>';
            //echo $this->Eleve->existe(array("nom"=>$items["nom"])).'<br>';
            echo $items["nom_absent"].'<br>';
        }
        echo 'Presence :';
        
        $this->Presence = new Model_DbTable_Flux_Presence();
        $this->Eleve = new Model_DbTable_Flux_Eleve();
        
        $tab2 = $this->Presence->get(null,10,0);
        //var_dump($tab2);
        
        foreach ($tab2 as $items) {
            echo $items["date"].'<br>';
            echo $items["id_etudiant"].'<br>';
            //echo $this->Eleve->existe(array("nom"=>$items["nom"])).'<br>';
            $row = $this->Eleve->findById($items["id_etudiant"]);
            echo $row["nom"].'<br>';
            echo $row["prenom"].'<br>';
        }
        
        
        
    }
    
    public function nbabsenceAction()
    {
        /* Initialize action controller here */
        $this->Absence = new Model_DbTable_Flux_Absence();
        $tab = $this->Absence->get(null,10,0);
        //var_dump($tab);
        $cpt = 0;
        
        foreach ($tab as $items) {
            
            $tab = $this->Absence->tokenization($items["nom_absent"],",",0,1);
            $cpt += count($tab);
        }
       
         echo "<p> Nombre d'absence Total : ".$cpt;
    }
    
    public function nbpresenceAction()
    {
        /* Initialize action controller here */
        $this->Presence = new Model_DbTable_Flux_Presence();
        $tab = $this->Presence->get(null,10,0);
        //var_dump($tab);
        $cpt = 0;
        
        foreach ($tab as $items) {
            
            $tab = $this->Presence->tokenization($items["nom_present"],",",0,1);
            $cpt += count($tab);
        }
       
         echo "<p> Nombre de Presence Total : ".$cpt;
    }
    
    public function graphAction()
    {
        
    }
    
    public function getpresenceAction()
    {
        
                     
				if($_POST)
				{
				/* VALUES */
				
				
				$nom=$_POST['nom'];
                                //$row = $this->dbpresence->findbynom($nom);
                                
                                $this->Presence = new Model_DbTable_Flux_Presence();
                                $tab = $this->Presence->get(null,10,0);
                                //var_dump($tab);
                                $cpt = 0;

                                foreach ($tab as $items) {

                                    $tab = $this->Presence->tokenization($items["nom_present"],",",0,1);
                                    //$tab_final = $this->Presence->tokenization($tab," ",0,1);
                                    foreach ($tab as $item) {
                                     
                                     $val = $this->Presence->tokenization($item," ",0,1);
                                        
                                     if($nom == $val[0])
                                    {
                                      $cpt += 1;  
                                    }
                                    
                                    } 
                                    
                                    
                                    
                                }           

                                 
                                echo '<div>Son nombre de presence '.$cpt.'</div>';
                                
                                
                               
                               // }
                                } else { 
 
						header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
						exit();
				}
    }

    public function getabsenceAction()
    {
        
                     
				if($_POST)
				{
				/* VALUES */
				
				
				$nom=$_POST['nom'];
                                //$row = $this->dbpresence->findbynom($nom);
                                
                                $this->Absence = new Model_DbTable_Flux_Absence();
                                $tab = $this->Absence->get(null,10,0);
                                //var_dump($tab);
                                $cpt = 0;

                                foreach ($tab as $items) {

                                    $tab = $this->Absence->tokenization($items["nom_present"],",",0,1);
                                    //$tab_final = $this->Presence->tokenization($tab," ",0,1);
                                    foreach ($tab as $item) {
                                     
                                     $val = $this->Absence->tokenization($item," ",0,1);
                                        
                                     if($nom == $val[0])
                                    {
                                      $cpt += 1;  
                                    }
                                    
                                    } 
                                    
                                    
                                    
                                }           

                                 
                                echo '<div>Son nombre d absence '.$cpt.'</div>';
                                
                                
                               
                               // }
                                } else { 
 
						header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
						exit();
				}
    }


}



