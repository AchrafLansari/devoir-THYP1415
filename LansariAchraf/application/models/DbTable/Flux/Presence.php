<?php
/**
 * Ce fichier contient la classe Presence.
 *
 * @copyright  2008 Gabriel Malkas
 * @license    "New" BSD License
*/

/**
 * @see Zend_Db_Table_Abstract
 */
require_once 'Zend/Db/Table/Abstract.php';

/**
 * Classe ORM qui représente la table 'presence'.
 *
 * @copyright  2008 Gabriel Malkas
 * @license    "New" BSD License
 */
class Model_DbTable_Flux_Presence extends Zend_Db_Table_Abstract
{
    
    /*
     * Nom de la table.
     */
    protected $_name = 'presence';
    
    /*
     * Clé primaire de la table.
     */
    protected $_primary = 'id';
    
    /**
     * Recherche une entrée Presence avec la clé primaire spécifiée
     * et modifie cette entrée avec les nouvelles données.
     *
     * @param integer $id
     * @param array $data
     *
     * @return void
     */
    public static function edit($id, $data)
    {        
        $db = Zend_Registry::get('dbAdapter');
        $db->update('presence', $data, 'presence.id = ' . $id);
    }
    
    /**
     * Recherche une entrée Presence avec la clé primaire spécifiée
     * et supprime cette entrée.
     *
     * @param integer $id
     *
     * @return void
     */
    public static function remove($id)
    {
        $db = Zend_Registry::get('dbAdapter');
        $db->delete('presence', 'presence.id = ' . $id);
    }
    
    /**
     * Récupère toutes les entrées Presence avec certains critères
     * de tri, intervalles
     */
    public function get($order=null, $limit=0, $from=0)
    {
        //$db = Zend_Registry::get('dbAdapter');
        
        $query = $this->select()
                    ->from( array("%ftable%" => "presence") );
                    
        if($order != null)
        {
            $query->order($order);
        }

        if($limit != 0)
        {
            $query->limit($limit, $from);
        }

        return $this->fetchAll($query)->toArray();
    }
    
    /*
     * Recherche une entrée Presence avec la valeur spécifiée
     * et retourne cette entrée.
     *
     * @param int $id
     */
    public static function findById($id)
    {
        $db = Zend_Registry::get('dbAdapter');

        $query = $db->select()
                    ->from( array("p" => "presence") )                           
                    ->where( "p.id = " . $id );

        return $db->fetchRow($query); 
    }
    /*
     * Recherche une entrée Presence avec la valeur spécifiée
     * et retourne cette entrée.
     *
     * @param date $date
     */
    public static function findByDate($date)
    {
        $db = Zend_Registry::get('dbAdapter');

        $query = $db->select()
                    ->from( array("p" => "presence") )                           
                    ->where( "p.date = " . $date );

        return $db->fetchRow($query); 
    }
    /*
     * Recherche une entrée Presence avec la valeur spécifiée
     * et retourne cette entrée.
     *
     * @param int $id_etudiant
     */
    public static function findById_etudiant($id_etudiant)
    {
        $db = Zend_Registry::get('dbAdapter');

        $query = $db->select()
                    ->from( array("p" => "presence") )                           
                    ->where( "p.id_etudiant = " . $id_etudiant );

        return $db->fetchRow($query); 
    }
    
    public function tokenization ($text,$delimiteurs,$nb_carac,$state)
        {
            $arrayElements = array();
            global $tab_mots_vides;
            $words = strtok($text,$delimiteurs);
            
            
             while ($words !== false){
                    if($state == 0){
                        $words = trim(str_replace('&nbsp','',$words));
                        $cpt = strlen($words);
                     if($cpt >= $nb_carac){
                         if (!array_key_exists($words,array_flip($tab_mots_vides)))
                             {
                                $arrayElements[]=$words;
                             }
                         
                         
                         }
                     
                    }else {
                        $arrayElements[]=$words;
                    }
                     $words = strtok($delimiteurs);
                 
             }
             return $arrayElements;
        }
        
        public  function findbynom($nom){
	try {
		//$db = Zend_Registry::get('dbAdapter');
		
		$resultat= $this->prepare("SELECT * FROM presence WHERE nom_present LIKE ? ");
		$resultat->bindValue(1, $nom, PDO::PARAM_STR);    
		$rows = $resultat->execute();
		return $rows;
	} 
	catch (PDOException $exc) 
	{
		echo $exc->getMessage();
		return false;
	}  
}
    
}
