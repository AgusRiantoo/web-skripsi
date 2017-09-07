<?php
// require(APPPATH.'libraries/REST_Controller.php');
include_once (dirname(__FILE__) . "/Auth.php");

class Comment extends Auth {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mymodel');
        $this->mymodel->table = 'comment';
    }

    function get($id = ''){
        $data = new stdClass();
        $cek = $this->check();
        if($cek->status) {
            $data->status = true;
            $data->message = 'success';
            $data->data = $this->mymodel->getComment('','',$id)->result();
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function getBy($id = ''){
        $data = new stdClass();
        $cek = $this->check();
        if($cek->status) {
            $data->status = true;
            $data->message = 'success';
            $data->data = $this->mymodel->getComment('','','',$id)->result();
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function create(){

        $cek = $this->check();
        $res = new stdClass();

        if ($cek->status) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('post_id', 'post_id', 'trim|required');
            $this->form_validation->set_rules('message', 'message', 'trim|required');

            if ($this->form_validation->run() == FALSE){
                $res->status = false;
                $res->message = 'Data tidak valid';
            }else{
                $user_id = $cek->id;
                $post_id = $this->input->post('post_id', TRUE);
                $message = $this->input->post('message', TRUE);

                $data = array(
                    'user_id'   => $user_id,
                    'post_id'   => $post_id,
                    'message'   => $message
                    );
                
                if ($this->mymodel->create($data)) {
                    $res->status = true;
                    $res->message = 'Berhasil menambahkan komentar';
                }else{
                    $res->status = false;
                    $res->message = 'Gagal menambahkan komentar';
                }

            }
            
        }else{
            $res->status = false;
            $res->message = 'Unauthenticated';
        }

        echo json_encode($res);
    }

}