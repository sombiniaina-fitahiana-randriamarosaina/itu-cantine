<?php
 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

 class Info extends REST_Controller{
     public function __construct() {
         parent::__construct();
     }

     // GET
     // http://localhost/ITU_Cantine/index.php/info
     public function index_get(){
         $data['nom'] = 'Randriamarosaina Sombiniaina Fitahiana';
         $data['etu'] = 'ETU000937';
         $this->response($data, REST_Controller::HTTP_OK);
     }
 }

?>
