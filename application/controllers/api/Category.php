<?php
// require(APPPATH.'libraries/REST_Controller.php');
include_once (dirname(__FILE__) . "/Auth.php");

class Category extends Auth {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mymodel');
        $this->mymodel->table = 'category';
    }

    function get($id = ''){
        $data = new stdClass();
        $cek = $this->check();
        if($cek->status) {
                $data->status = true;
            if ($id == '') {
                    $q = $this->mymodel->read();
                    $data->data = $q->result();
            }else{
                    $q = $this->mymodel->read_by_id('id',$id);
                    $data->data = $q->row();                
            }
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }
        echo json_encode($data,JSON_PRETTY_PRINT);
    }

}