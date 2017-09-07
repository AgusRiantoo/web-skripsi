<?php
// require(APPPATH.'libraries/REST_Controller.php');
include_once (dirname(__FILE__) . "/Auth.php");

class Report extends Auth {
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
            $by = $this->input->get('by');
            $id = $this->input->get('id');
            $data->status = true;
            $data->message = 'success';
            if ($by == '' || $by == null) {
                    $q = $this->mymodel->read();
                    $data->data = $q->result();
            }else{
                    $q = $this->mymodel->read_by_id($by,$id);
                    $data->data = $q->result();                
            }
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function create(){
        
        $data = new stdClass();
        $cek = $this->check();
        if ($cek->status) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('post_id', 'post_id', 'trim|required');
            $this->form_validation->set_rules('message', 'message', 'trim|required');

            if ($this->form_validation->run() == FALSE){
                $data->status = false;
                $data->message = 'Data tidak valid';
            }else{
                $user_id = $cek->id;
                $post_id = $this->input->post('post_id', TRUE);
                $message = $this->input->post('message', TRUE);

                $data2 = array(
                    'user_id'   => $user_id,
                    'post_id'   => $post_id,
                    'message'   => $message
                    );
                
                if ($this->mymodel->create($data2)) {
                    $data->status = true;
                    $data->message = 'Berhasil menambahkan Laporan';
                }else{
                    $data->status = false;
                    $data->message = 'Gagal menambahkan Laporan';
                }

            }
            
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

}