<?php
// require(APPPATH.'libraries/REST_Controller.php');
include_once (dirname(__FILE__) . "/Auth.php");

class Activity extends Auth {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mymodel');
        $this->mymodel->table = 'comment';
    }

    function get(){
        $data = new stdClass();
        $cek = $this->check();
        if($cek->status) {
                $data->status = true;
                $q = $this->mymodel->getActivity($cek->id);
                $data->data = $q->result();                
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }
        echo json_encode($data);
    }

}