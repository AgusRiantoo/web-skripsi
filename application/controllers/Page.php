<?php

class Page extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mymodel');
        $this->load->library('session');

    }

public function index()
{
	redirect('page/login');
}

public function login()
{
    $data['msg'] = '';
    if (isset($_POST['submit'])) {
        $u = $this->input->post('username', TRUE);
        $p = $this->input->post('password', TRUE);
        $enc = hash ( "sha256", $p);
        $q = $this->mymodel->cek($u,$enc);
        if ($q) {
            $q= $q->row();
            if ($q->role == '1') {
                $this->session->set_userdata(
                    array(
                          'isLogin' => true,
                          'user_id' => $q->id,
                          'username' => $q->name,
                        ));
                redirect('admin');
            }else{
                $data['msg'] = 'Anda tidak memiliki akses ke halaman web<br>';
            }

        }else{
            $data['msg'] = 'Username / Password Salah! <br>';
        }
    }
    $this->load->view('admin/login',$data);
}

public function logout()
{
    $this->session->sess_destroy();
    redirect('page/login');
}

}