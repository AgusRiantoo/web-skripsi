<?php
// require(APPPATH.'libraries/REST_Controller.php');
include_once (dirname(__FILE__) . "/Auth.php");

class News extends Auth {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mymodel');
        $this->mymodel->table = 'news';
    }

    function get($id = ''){
        $res = new stdClass();
        $cek = $this->check();
        // if($cek->status) {
                $res->status = true;
            if ($id == '') {
                    $q = $this->mymodel->read();
                    $res->data = $q->result();
            }else{
                    $q = $this->mymodel->read_by_id('id',$id);
                    $res->data = $q->row();            
            }
        // }else{
        //     $res->status = false;
        //     $res->message = 'Unauthenticated';
        // }
echo json_encode($res,JSON_PRETTY_PRINT);
    }

}