<?php
 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

 class Commandes extends REST_Controller{
     public function __construct() {
         parent::__construct();
         $this->load->database();
         $this->load->Model('Commande');
     }

     // GET
     // http://localhost/ITU_Cantine/index.php/api/commandes
     // http://localhost/ITU_Cantine/index.php/api/commandes/total/ETU000937
     public function index_get($action='', $numETU=''){
         if($action == 'total'){
             $data = $this->Commande->getTotal($numETU);
             $this->response($data, REST_Controller::HTTP_OK);
         }
         else {
             $data = $this->Commande->findAll();
             $this->response($data, REST_Controller::HTTP_OK);
         }
     }

     // POST
     // http://localhost/ITU_Cantine/index.php/api/commandes
     public function index_post(){
        $input = $this->input->post();

        $newCommande = new Commande('', '', $input['numETU'], new Plat($input['codePlat'], '', 0, ''), $input['nombre']);
        $newCommande->insert();

        $this->response(['Commandes created successfully.'], REST_Controller::HTTP_OK);
     }

     // PUT
     // http://localhost/ITU_Cantine/index.php/api/commandes/1
     public function index_put($idCommande)
     {
         $input = $this->put();
         $input = json_decode($input[0]);
         $newCommande = new Commande($idCommande, '', '', new Plat($input->codePlat, '', 0, ''), $input->nombre);
         $newCommande->update();
         $this->response(['Commande updated successfully.'], REST_Controller::HTTP_OK);
     }
 }

?>
