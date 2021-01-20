<?php
 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

 class Menus extends REST_Controller{
     public function __construct() {
         parent::__construct();
         $this->load->database();
         $this->load->Model('Menu');
         $this->load->Model('Commande');
     }

     // GET
     // http://localhost/ITU_Cantine/index.php/api/menus
     public function index_get(){
         $data = $this->Menu->findMenuDuJour();
         $this->response($data, REST_Controller::HTTP_OK);
     }
 }

?>
