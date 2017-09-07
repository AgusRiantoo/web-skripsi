<?php
// require(APPPATH.'libraries/REST_Controller.php');
include_once (dirname(__FILE__) . "/Auth.php");

class Post extends Auth {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mymodel');
        $this->mymodel->table = 'post';
    }

    function get($id = ''){
        $data = new stdClass();
        $cek = $this->check();
        if($cek->status) {
                $data->status = true;
                $data->message = 'success';
            if ($id == '') {
                    $q = $this->mymodel->getPost();
                    $data->data = $q->result();
            }else{
                    $q = $this->mymodel->getPost($id);
                    $data->data = $q->row();                
            }
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
            $q = $this->mymodel->getPost('','','','','',$id);
            $data->data = $q->result();                
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function create(){

        $cek = $this->check();
        if ($cek->status) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');

            $res = new stdClass();
            if ($this->form_validation->run() == FALSE)
            {
                $res->status = false;
                $res->message = 'Data tidak valid';
            }
            else
            {
                $user_id = $cek->id;
                $category_id = $this->input->post('category_id', TRUE);
                $description = $this->input->post('description', TRUE);
                $address = $this->input->post('address', TRUE);
                $latitude = $this->input->post('latitude', TRUE);
                $longitude = $this->input->post('longitude', TRUE);

                $config['encrypt_name'] = true;
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
                $config['max_size'] = 10000;

                $this->load->library('upload', $config);

                if($this->upload->do_upload('input_file')) {
                    $upload = $this->upload->data();
                    $file_name = $upload['file_name'];
                }else{
                    $file_name = '';
                }

                $data = array(
                    'user_id'       => $user_id,
                    'category_id'   => $category_id,
                    'description'   => $description,
                    'file_name'     => $file_name,
                    'address'       => $address,
                    'latitude'      => $latitude,
                    'longitude'     => $longitude,
                    );
                
                if ($this->mymodel->create($data)) {
                    $res->status = true;
                    $res->message = 'Berhasil menambahkan postingan';
                }else{
                    $res->status = false;
                    $res->message = 'Gagal menambahkan postingan';
                }

            }
            
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }

        echo json_encode($res);
    }

    function test($id = ''){
        $old = $this->mymodel->read_by_id('id',$id)->row()->status;
        var_dump($old);
    }

    function changeStatus($id = ''){
        $cek = $this->check();
        $res = new stdClass();

        if($cek->status) {
            $status = $this->mymodel->read_by_id('id',$id)->row();
            if ($status) {
                switch ($status->status) {
                case '0':
                $change = '1';
                $message = 'Laporan berhasil dirubah menjadi dikerjakan';
                    break;

                case '1':
                $change = '2';
                $message = 'Laporan berhasil dirubah menjadi selesai';
                    break;
                
                default:
                    $change = '2';
                    $message = 'Laporan sudah diselesaikan';
                    break;
                }
                $data = array('status' => $change);

                if ($this->mymodel->update($id,$data)) {
                    $res->status = true;
                    $res->message = $message;
                }else{
                    $res->status = false;
                    $res->message = 'Gagal mengubah status laporan';
                }
            }else{
                $res->status = false;
                $res->message = 'Laporan tidak ditemukan';
            }
            
        }else{
            $res->status = false;
            $res->message = 'Unauthenticated';
        }

        echo json_encode($res, JSON_PRETTY_PRINT);
    }

    function search(){
        $data = new stdClass();
        $cek = $this->check();
        if($cek->status) {
            $data->status = true;
            $data->message = 'success';
            $cari = $this->input->get('key');
            $q = $this->mymodel->search($cari);
            $data->data = $q->result();
        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }
        echo json_encode($data);
    }
}