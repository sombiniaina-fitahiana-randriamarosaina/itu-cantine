<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Menu extends CI_Model implements JsonSerializable{
    // CONSTRUCTOR
    public function __construct($Plat = '', $dateMenu = ''){
        parent:: __construct();
        $this->load->Model('Plat');
        $this->setPlat($Plat);
        $this->setDateMenu($dateMenu);
    }

    // FIELDS
    protected $_plat;
    protected $_dateMenu;


    // GETTERS
    public function getPlat(){
        return $this->_plat;
    }
    public function getDateMenu(){
        return $this->_dateMenu;
    }

    // SETTERS
    public function setPlat($plat){
        $this->_plat = $plat;
    }
    public function setDateMenu($dateMenu){
        $this->_dateMenu = $dateMenu;
    }
    public function jsonSerialize()
    {
        return
        [
            'codePlat'   => $this->getPlat()->getCodePlat(),
            'intitule' => $this->getPlat()->getIntitule(),
            'prix' => $this->getPlat()->getPrix(),
            'devise' => $this->getPlat()->getDevise(),
            'dateMenu' => $this->getDateMenu()
        ];
    }

    public function findMenuDuJour(){
        $MenuDuJour = array();

        $sql = "SELECT * FROM MENUDUJOUR";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $plat = new Plat((int)$row['CODEPLAT'], $row['INTITULE'], (float)$row['PRIX'], $row['DEVISE']);
            array_push($MenuDuJour, new Menu($plat, $row['DATEMENU']));
        }
        return $MenuDuJour;
    }
}
?>
