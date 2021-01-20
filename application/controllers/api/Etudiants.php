<?php
 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

 class Etudiants extends REST_Controller{
     public function __construct() {
         parent::__construct();
         $this->load->database();
         $this->load->Model('Etudiant');
     }

     // POST
     // http://localhost/ITU_Cantine/index.php/api/etudiants/login
     // http://localhost/ITU_Cantine/index.php/api/etudiants
     public function index_post($params=''){
         $input = $this->input->post();

         if($params == 'login'){
             $newEtudiant = new Etudiant($input['numETU'], $input['motDePasse']);
             if($newEtudiant->connection()){
                 $token = sha1($input['numETU'] . $input['motDePasse']);
                 $data['token'] = $token;
                 $this->response($data, REST_Controller::HTTP_OK);
             }
         }
         else{
             $newEtudiant = new Etudiant($input['numETU'], $input['motDePasse'], $input['nom'], $input['dateNaissance']);
             $newEtudiant->insert();
             $this->response(['Etudiant created successfully.'], REST_Controller::HTTP_OK);
         }
     }

     // PUT
     // http://localhost/ITU_Cantine/index.php/api/etudiants/ETU000937
     public function index_put($numETU)
     {
         $input = $this->put();
         $input = json_decode($input[0]);
         $newEtudiant = new Etudiant($numETU, '', $input->nom, $input->dateNaissance);
         $newEtudiant->update();
         $this->response(['Information updated successfully.'], REST_Controller::HTTP_OK);
     }
 }

?>
