<?php

class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mymodel');
        $this->load->library('session');
        if (!$this->session->userdata('isLogin')) {
            redirect('page/login');
        }
    }

public function index()
{
	redirect('admin/dasboard');
}

public function dasboard()
{
	$data['body'] = 'admin/body';
    $this->mymodel->table = 'post';
	$data['total']	= $this->mymodel->read()->num_rows();
	$data['new']	= $this->mymodel->read_by_id('status','0')->num_rows();
	$data['done']	= $this->mymodel->read_by_id('status','1')->num_rows();

	$data['laporan']= $this->mymodel->getPost('','','5');

	$data['komentar']= $this->mymodel->getComment('5');

	// var_dump($data['komentar']);
	// exit();
	$this->load->view('admin/content',$data);
}

public function user()
{

    $this->mymodel->table = 'user';
    $user = $this->input->get('userid');
    $search = $this->input->get('search');
    $delete = $this->input->get('delete');
    $limit = $this->input->get('display');
    if ($delete != '') {
    	$this->mymodel->delete($delete);
    	redirect('admin/user');
    }

    if ($user != '') {
		$data['body'] = 'admin/body-user-single';
    	$data['user']= $this->mymodel->read_by_id('id',$user)->row();
    	if (isset($_POST['submit'])) {
    		$data = array(
                'email'     => $this->input->post('email'),
                'name'      => $this->input->post('name'),
                'phone'  => $this->input->post('phone'),
                'role'     	=> $this->input->post('role'),
                'status'	=> $this->input->post('status')
                );
    		$this->mymodel->update($user,$data);
    		redirect('admin/user');
    	}

    }else{
		$data['body'] = 'admin/body-user';
	    $data['user']= $this->mymodel->read($limit,$search);
    }
		$this->load->view('admin/content',$data);
}

public function laporan()
{
    $id = $this->input->get('id');
    $delete = $this->input->get('delete');


    $this->mymodel->table = 'post';
    if ($delete != '') {
        $this->mymodel->delete($delete);
        redirect('admin/laporan');
    }

    if ($id != '') {
		$data['body'] = 'admin/body-laporan-single';
		$q = $this->mymodel->getPost($id);
        if ($q->num_rows() == 0) {
            redirect('admin/laporan');
        }else{
        $data['laporan']= $q->row();
        $data['komentar']= $this->mymodel->getComment('10','',$id);

        }

        if (isset($_POST['submit'])) {
            $data = array(
                'status'    => $this->input->post('status')
                );
            $this->mymodel->update($id,$data);
            redirect('admin/laporan');
        }
    	
    }else{
		$data['body'] = 'admin/body-laporan';
	    $this->mymodel->table = 'category';
	    $data['category']= $this->mymodel->read();
	    $this->mymodel->table = 'post';

	    $limit = $this->input->get('display');
	    $category = $this->input->get('category');
	    $search = $this->input->get('search');
        $status = $this->input->get('status');

	    $data['query']= $this->mymodel->getPost('',$category,$limit,$search, $status);
	    // var_dump($data['query']->result());
		// exit();
	}
	$this->load->view('admin/content',$data);
}

public function report()
{
    $this->mymodel->table = 'feedback';
    $search = $this->input->get('search');
    $delete = $this->input->get('delete');
    $limit = $this->input->get('display');
    if ($delete != '') {
        $this->mymodel->delete($delete);
        redirect('admin/report');
    }

    $data['body'] = 'admin/body-report';
    $data['user']= $this->mymodel->getReport($search,$limit);
	$this->load->view('admin/content',$data);
}

public function kategori()
{
	$data['body'] = 'admin/body-kategori';
    $this->mymodel->table = 'category';
    $data['query']= $this->mymodel->read();
    $update = $this->input->get('update');
    $delete = $this->input->get('delete');
    if ($delete != '') {
        $this->mymodel->delete($delete);
        redirect('admin/kategori');
    }
    if ($update != '') {
        $data['kategori'] = $this->mymodel->read_by_id('id',$update)->row();
        if (isset($_POST['submit'])) {

            $config['encrypt_name'] = true;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 5000;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('input_file')) {
                $upload = $this->upload->data();
                $file = $upload['file_name'];
            }else{
                $file = $this->input->post('input_file_old');
            }

                $data = array(
                    'name'        => $this->input->post('nama'),
                    'description' => $this->input->post('deskripsi'),
                    'icon'        => $file
                    );
                $this->mymodel->update($update,$data);
                redirect('admin/kategori');
            }
    }else{
        if (isset($_POST['submit'])) {
            $config['encrypt_name'] = true;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 5000;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('input_file')) {
                $upload = $this->upload->data();
                $file = $upload['file_name'];
            }else{
                $file = 'default.jpg';
            }

                $data = array(
                    'name'        => $this->input->post('nama'),
                    'description' => $this->input->post('deskripsi'),
                    'icon'        => $file
                    );
                $this->mymodel->create($data);
                redirect('admin/kategori');
            }
    }

	$this->load->view('admin/content',$data);
}

public function komentar()
{
    $this->mymodel->table = 'comment';
    $search = $this->input->get('search');
    $delete = $this->input->get('delete');
    $limit = $this->input->get('display');
    if ($delete != '') {
        $this->mymodel->delete($delete);
        redirect('admin/komentar');
    }

    $data['body'] = 'admin/body-komentar';
    $data['user']= $this->mymodel->getComment($limit,$search);
    $this->load->view('admin/content',$data);
}

public function berita()
{
    $data['body'] = 'admin/body-berita';
    $this->mymodel->table = 'news';
    $data['query']= $this->mymodel->read();
    $update = $this->input->get('update');
    $delete = $this->input->get('delete');
    if ($delete != '') {
        $this->mymodel->delete($delete);
        redirect('admin/berita');
    }
    
    if ($update != '') {
        if (isset($_POST['submit'])) {

            $config['encrypt_name'] = true;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 5000;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('input_file')) {
                $upload = $this->upload->data();
                $file = $upload['file_name'];
            }else{
                $file = $this->input->post('input_file_old');
            }
                $data = array(
                    'title'       => $this->input->post('title'),
                    'description' => $this->input->post('deskripsi'),
                    'file_name'   => $file
                    );
                $this->mymodel->update($update,$data);
                redirect('admin/berita');
            }else{
                $data['row'] = $this->mymodel->read_by_id('id',$update)->row();

            }
    }else{
        if (isset($_POST['submit'])) {

            $config['encrypt_name'] = true;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 5000;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('input_file')) {
                $upload = $this->upload->data();
                $file = $upload['file_name'];
            }else{
                $file = 'null';
            }

                $data = array(
                    'title'       => $this->input->post('title'),
                    'description' => $this->input->post('deskripsi'),
                    'file_name'   => $file
                    );
                $this->mymodel->create($data);
                redirect('admin/berita');
            }
    }

    $this->load->view('admin/content',$data);
}

public function chatroom()
{
    $this->mymodel->table = 'chatroom';

    $id = $this->input->get('id');
    $delete = $this->input->get('delete');
    $search = $this->input->get('search');
    $limit = $this->input->get('display');

    if ($delete != '') {
        $this->mymodel->delete($delete);
        redirect('admin/chatroom');
    }

    if ($id == '') {
        $data['query']= $this->mymodel->readChat($limit,$search);
        $data['body'] = 'admin/body-chatroom';

    }else{
        $data['room']= $this->mymodel->read_by_id('id',$id)->row();
        $this->mymodel->table = 'chat';
        $data['query']= $this->mymodel->getChat($id, 'asc');
        $data['body'] = 'admin/body-chatroom-detail';

        if (isset($_POST['submit'])) {
            $data = array(
                'room_id'   => $id,
                'user_id'   => $this->session->userdata('user_id'),
                'message'   => $this->input->post('message')
            );
            $this->mymodel->create($data);
            redirect('admin/chatroom?id='.$id);
        }

    }
    
    $this->load->view('admin/content',$data);
}


}

?>