<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Plat extends CI_Model{
    // CONSTRUCTOR
    public function __construct($codePlat = '', $intitule = '', $prix = '',$devise = ''){
        parent:: __construct();
        $this->setCodePlat($codePlat);
        $this->setIntitule($intitule);
        $this->setPrix($prix);
        $this->setDevise($devise);
    }

    // FIELDS
    protected $_codePlat;
    protected $_intitule;
    protected $_prix;
    protected $_devise;


    // GETTERS
    public function getCodePlat(){
        return $this->_codePlat;
    }
    public function getIntitule(){
        return $this->_intitule;
    }
    public function getPrix(){
        return $this->_prix;
    }
    public function getDevise(){
        return $this->_devise;
    }


    // SETTERS
    public function setCodePlat($codePlat){
        $this->_codePlat = $codePlat;
    }
    public function setIntitule($intitule){
        $this->_intitule = $intitule;
    }
    public function setPrix($prix){
        $this->_prix = $prix;
    }
    public function setDevise($devise){
        $this->_devise = $devise;
    }
}
?>
