<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Commande extends CI_Model implements JsonSerializable{
    // CONSTRUCTOR
    public function __construct($idCommande = '', $dateCommande = '', $numETU = '', $plat = '', $nombre = ''){
        parent:: __construct();
        $this->load->Model('Plat');
        $this->setIdCommande($idCommande);
        $this->setDateCommande($dateCommande);
        $this->setNumETU($numETU);
        $this->setPlat($plat);
        $this->setNombre($nombre);
    }

    // FIELDS
    protected $_idCommande;
    protected $_dateCommande;
    protected $_numETU;
    protected $_plat;
    protected $_nombre;

    // GETTERS
    public function getIdCommande(){
        return $this->_idCommande;
    }
    public function getDateCommande(){
        return $this->_dateCommande;
    }
    public function getNumETU(){
        return $this->_numETU;
    }
    public function getPlat(){
        return $this->_plat;
    }
    public function getNombre(){
        return $this->_nombre;
    }

    // SETTERS
    public function setIdCommande($idCommande){
        $this->_idCommande = $idCommande;
    }
    public function setDateCommande($dateCommande){
        $this->_dateCommande = strtotime($dateCommande);
    }
    public function setNumETU($numETU){
        $this->_numETU = $numETU;
    }
    public function setPlat($plat){
        $this->_plat = $plat;
    }
    public function setNombre($nombre){
        $this->_nombre = $nombre;
    }

    public function jsonSerialize()
    {
        return
        [
            'codePlat' => $this->getPlat()->getCodePlat(),
            'intitule' => $this->getPlat()->getIntitule(),
            'nombre' => $this->getNombre()
        ];
    }

    public function insert(){
        $sql = "INSERT INTO COMMANDE (NUMETU, CODEPLAT, NOMBRE) VALUES ('%s', %d, %d)";
        $sql = sprintf($sql, $this->getNumETU(), $this->getPlat()->getCodePlat(), $this->getNombre());
        $query = $this->db->query($sql);
    }
    public function update(){
        $sql = "UPDATE COMMANDE SET CODEPLAT = %d, NOMBRE=%d WHERE IDCOMMANDE=%d";
        $sql = sprintf($sql, $this->getPlat()->getCodePlat(), $this->getNombre(), $this->getIdCommande());
        $query = $this->db->query($sql);
    }
    public function getTotal($numETU){
        $total = array();
        $total['numETU'] = $numETU;

        $sql = "SELECT * FROM ADDITION WHERE NUMETU='%s'";
        $sql = sprintf($sql, $numETU);
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $total['total'] = $row['TOTAL'];
            $total['devise'] = $row['DEVISE'];
        }
        return $total;
    }
    public function findAll(){
        $Commandes = array();

        $sql = "SELECT * FROM COMMANDEDUJOUR";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $plat = new Plat($row['CODEPLAT'], $row['INTITULE'], 0, '');
            array_push($Commandes, new Commande('', '', '', $plat, $row['NOMBRE']));
        }
        return $Commandes;
    }
}
?>
