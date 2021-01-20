<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Etudiant extends CI_Model{
    // CONSTRUCTOR
    public function __construct($numETU = '', $motDePasse = '', $nom = '',$dateNaissance = ''){
        parent:: __construct();
        $this->setNumETU($numETU);
        $this->setMotDePasse($motDePasse);
        $this->setNom($nom);
        $this->setDateNaissance($dateNaissance);
    }

    // FIELDS
    protected $_numETU;
    protected $_motDePasse;
    protected $_nom;
    protected $_dateNaissance;

    // GETTERS
    public function getNumETU(){
        return $this->_numETU;
    }
    public function getMotDePasse(){
        return $this->_motDePasse;
    }
    public function getNom(){
        return $this->_nom;
    }
    public function getDateNaissance(){
        return $this->_dateNaissance;
    }

    // SETTERS
    public function setNumETU($numETU){
        $this->_numETU = $numETU;
    }
    public function setMotDePasse($motDePasse){
        $this->_motDePasse = $motDePasse;
    }
    public function setNom($nom){
        $this->_nom = $nom;
    }
    public function setDateNaissance($dateNaissance){
        $this->_dateNaissance = strtotime($dateNaissance);
    }

    public function insert(){
        $sql = "INSERT INTO ETUDIANT (NUMETU, MOTDEPASSE, NOM, DATENAISSANCE) VALUES ('%s', SHA1('%s'), '%s', %s)";
        $sql = sprintf($sql, $this->getNumETU(), $this->getMotDePasse(), $this->getNom(), 'STR_TO_DATE(\''. date('d-m-Y', $this->getDateNaissance()) ."', '%d-%m-%Y')");
        $query = $this->db->query($sql);
    }
    public function connection(){
        $sql = "INSERT INTO CONNEXION (NUMETU, TOKEN) SELECT NUMETU, SHA1(NUMETU || MOTDEPASSE) FROM ETUDIANT WHERE NUMETU='%s' AND MOTDEPASSE=SHA1('%s')";
        $sql = sprintf($sql, $this->getNumETU(), $this->getMotDePasse());
        $query = $this->db->query($sql);
        return true;
    }
    public function update(){
        $sql = "UPDATE ETUDIANT SET NOM = '%s', DATENAISSANCE=%s WHERE NUMETU='%s'";
        $sql = sprintf($sql, $this->getNom(), 'STR_TO_DATE(\''. date('d-m-Y', $this->getDateNaissance()) ."', '%d-%m-%Y')", $this->getNumETU());
        $query = $this->db->query($sql);
    }
}
?>
