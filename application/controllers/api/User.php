    <?php
// require(APPPATH.'libraries/REST_Controller.php');
include_once (dirname(__FILE__) . "/Auth.php");

class User extends Auth {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mymodel');
    }

    function get(){
        $data = new stdClass();
        $cek = $this->check();
        if ($cek->status) {
            $q = $this->mymodel->read_by_id('id',$cek->id);
            $data->status = true;
            $data->message = 'success';
            $data->data = $q->row();
            $data->laporan = $this->mymodel->counts('post',$cek->id);
            $data->pertanyaan = $this->mymodel->counts('chatroom',$cek->id);
            $data->komentar = $this->mymodel->counts('comment',$cek->id);

        }else{
            $data->status = false;
            $data->message = 'Unauthenticated';
        }
            echo json_encode($data,JSON_PRETTY_PRINT);
    }

    function login(){
        $email      = $this->input->post('email', true);
        $password   = $this->input->post('password', true);
        $q = $this->mymodel->cek($email, hash("sha256", $password));
        $res = new stdClass();
        if ($q) {
            if ($q->row()->status == 1) {
                $res->status = true;
                $res->message = 'Loggin success';
                $res->data = $q->row();
            }else if ($q->row()->status == 0){
                $res->status = false;
                $res->message = 'Akun anda belum di aktifkan, silahkan verifikasi akun anda!';
            }else{
                $res->status = false;
                $res->message = 'Maaf, akun anda telah di blokir!';
            }

        }else{
            $res->status = false;
            $res->message = 'Email or password is wrong!';
        }
        echo json_encode($res,JSON_PRETTY_PRINT);
    }

    function register(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');

        $res = new stdClass();
        if ($this->form_validation->run() == FALSE)
        {
            $res->status = false;
            $res->message = 'Maaf, akun email sudah terdaftar.';
        }
        else
        {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);
            $name = $this->input->post('name', TRUE);
            $no = $this->input->post('phone', TRUE);

            $data = array(
                'email'     => $email,
                'password'  => hash('sha256', $password),
                'name'      => $name,
                'phone'     => $no,
                'token'     => hash('sha256',"sb-".$email."-".date("Y-m-d H:i:s")),
                'activation_code'   => hash('sha256', $email."-".date("Y-m-d H:i:s")),
                );
            if ($this->mymodel->create($data)) {
                $res->status = true;
                $res->message = 'Akun berhasil didaftarkan';
                $id = $this->db->insert_id();
                $this->sendemail($id);

            }else{
                $res->status = false;
                $res->message = 'Gagal mendaftarkan akun';
            }

        }

        echo json_encode($res, JSON_PRETTY_PRINT);
    }

    function update(){
        $cek = $this->check();
        $res = new stdClass();

        if($cek->status) {
            $this->load->library('form_validation');
            $old = $this->mymodel->read_by_id('id',$cek->id)->row()->password;
            $password_lama = $this->input->post('password_lama', TRUE);
            $password = $this->input->post('password', TRUE);

            if ($old != hash('sha256', $password_lama)) {
                $res->status = false;
                $res->message = 'Password tidak sesuai';
            }else{
                $name = $this->input->post('name', TRUE);
                $no = $this->input->post('phone', TRUE);
                $data = array(
                    'password'  => hash('sha256', $password),
                    'name'      => $name,
                    'phone'     => $no
                    );
                if ($this->mymodel->update($cek->id,$data)) {
                    $res->status = true;
                    $res->message = 'Berhasil memperbarui data';
                }else{
                    $res->status = false;
                    $res->message = 'Gagal memperbarui data';
                }
            }
        }else{
            $res->status = false;
            $res->message = 'Unauthenticated';
        }

        echo json_encode($res, JSON_PRETTY_PRINT);
    }

    function updateAvatar(){
        $cek = $this->check();
        $res = new stdClass();

        if($cek->status) {
            $config['encrypt_name'] = true;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
            $config['max_size'] = 10000;

            $this->load->library('upload', $config);

            if($this->upload->do_upload('input_file')) {
                $upload = $this->upload->data();
                $file_name = $upload['file_name'];
                $data = array(
                    'avatar'     => $file_name
                    );
                if ($this->mymodel->update($cek->id,$data)) {
                    $res->status = true;
                    $res->message = 'Berhasil memperbarui avatar';
                }else{
                    $res->status = false;
                    $res->message = 'Gagal memperbarui avatar';
                }
            }else{
                $res->status = false;
                $res->message = 'Gagal memperbarui avatar';
            }
        }else{
            $res->status = false;
            $res->message = 'Unauthenticated';
        }

        echo json_encode($res, JSON_PRETTY_PRINT);
    }

    function sendemail($id='', $email=''){
        $this->load->library('email');
        
        $config['useragent'] = 'CodeIgniter';
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';   //examples: ssl://smtp.googlemail.com, myhost.com
        $config['smtp_port'] = '465';

        $config['smtp_timeout'] = 10;
        
        // $config['smtp_user'] = 'kyo.rikimaru@gmail.com';
        // $config['smtp_pass'] = 'death525';
        $config['smtp_user'] = 'agusriantox@gmail.com';
        $config['smtp_pass'] = 'death525';

        $config['charset']='utf-8';  // Default should be utf-8 (this should be a text field)
        $config['newline']="\r\n"; //"\r\n" or "\n" or "\r". DEFAULT should be "\r\n"
        $config['crlf'] = "\r\n"; //"\r\n" or "\n" or "\r" DEFAULT should be "\r\n"
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        if ($id != '') {
            $user = $this->mymodel->read_by_id('id',$id)->row();
        }else if ($email != ''){
            $user = $this->mymodel->read_by_id('email',$email)->row();
        }else{
            redirect();
        }
        if ($user) {
        $this->email->from('agusriantox@gmail.com', 'Agus Rianto');
        $this->email->to($user->email);

        $this->email->subject('Depok Smart City Registration');


        $body = 'Halo, '.$user->name.'.
Anda telah berhasil melakukan registrasi pada aplikasi Depok Smart City.
Berikut ini adalah data anda :
        Nama         : '.$user->name.'
        No Telepon   : '.$user->phone.'
        Email        : '.$user->email.'

Silahkan klik link berikut ini untuk mengaktifkan akun anda : '.
base_url('api/user/activation/'.$user->activation_code);

        $this->email->message($body);

        if ($this->email->send()) {
            return true;
        }else{
            return false;
        }
    }else{
        echo "Maaf email tidak ditemukan";
        return false;
    }

    }

    function resend(){
        $key = $this->input->get_request_header('Authorization', TRUE);
        $email = $this->input->post('email');

        if ($key == 'mdsc') {
            $q=$this->mymodel->read_by_id('email',$email);
            if ($q->num_rows() == 0) {
                echo "Maaf email tidak ditemukan";
            }else{
                if ($q->row()->status == 1) {
                    echo "Akun anda sudah aktif.";
                }else{
                    if ($this->sendemail('',$email)) {
                        echo "Berhasil mengirim kode aktifasi, silahkan cek email anda untuk aktivasi akun.";
                    }else{
                         echo "Maaf, tidak dapat mengirim kode verifikasi anda.";

                    }
                }
            }
        }else{
            echo "Maaf, tidak dapat mengirim kode aktifasi.";
        }
    }

    function activation($id=''){
        $user = $this->mymodel->read_by_id('activation_code',$id)->row();
        if ($user) {
            if ($user->status == '0') {
                $data = array('status' => '1');
                $this->mymodel->update($user->id,$data);            
                $data['msg'] = 'Selamat, akun anda telah berhasil di aktifkan.<br> Silahkan login kembali dengan menggunakan akun anda.';
            }else{
                $data['msg'] = 'Akun anda sudah pernah diaktifkan.';
            }
        }else{
            $data['msg'] = 'Maaf, kode aktifasi anda salah.';
        }
        $this->load->view('admin/body-verification',$data);
    }
}