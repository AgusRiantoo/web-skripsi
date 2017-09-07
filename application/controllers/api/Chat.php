<?php
// require(APPPATH.'libraries/REST_Controller.php');
include_once (dirname(__FILE__) . "/Auth.php");

class Chat extends Auth {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mymodel');
        $this->mymodel->table = 'chat';
    }

    function get($id = ''){
        $data = new stdClass();
        $cek = $this->check();
        if($cek->status) {
            if ($id != '') {
                $data->status = true;
                $data->message = 'success';

                $q = $this->mymodel->getChat($id);
                $data->data = $q->result();                
            }else{
                $data->status = false;
                $data->message = 'Room not found';

            }
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function getRoom($id = ''){
        $this->mymodel->table = 'chatroom';
        $data = new stdClass();
        $cek = $this->check();
        if($cek->status) {
            if ($id != '') {
                $data->status = true;
                $data->message = 'success';

                $q = $this->mymodel->read_by_id('user_id',$id);
                $data->data = $q->result();                
            }else{
                $data->status = false;
                $data->message = 'Room not found';

            }
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function create(){

        $cek = $this->check();
        $data = new stdClass();

        if ($cek->status) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('room_id', 'room_id', 'trim|required');
            $this->form_validation->set_rules('message', 'message', 'trim|required');

            if ($this->form_validation->run() == FALSE){
                $data->status = false;
                $data->message = 'Data tidak valid';
            }else{
                $user_id = $cek->id;
                $room_id = $this->input->post('room_id', TRUE);
                $message = $this->input->post('message', TRUE);

                $data2 = array(
                    'user_id'   => $user_id,
                    'room_id'   => $room_id,
                    'message'   => $message
                    );
                
                if ($this->mymodel->create($data2)) {
                    $data->status = true;
                    $data->message = 'Berhasil mengirim pesan.';
                }else{
                    $data->status = false;
                    $data->message = 'Gagal mengirim pesan.';
                }

            }
            
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function createRoom(){
        $this->mymodel->table = 'chatroom';
        $cek = $this->check();
        $data = new stdClass();

        if ($cek->status) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'title', 'trim|required');

            if ($this->form_validation->run() == FALSE){
                $data->status = false;
                $data->message = 'Data tidak valid';
            }else{
                $user_id = $cek->id;
                $room_id = $this->input->post('room_id', TRUE);
                $title = $this->input->post('title', TRUE);

                $data2 = array(
                    'user_id'   => $user_id,
                    'title'   => $title
                    );
                
                if ($this->mymodel->create($data2)) {
                    $data->status = true;
                    $data->message = 'Berhasil mengirim pesan.';
                }else{
                    $data->status = false;
                    $data->message = 'Gagal mengirim pesan.';
                }

            }
            
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

}