    <?php
//require(APPPATH.'libraries/REST_Controller.php');

class Auth extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mymodel');
    }

    public function index(){
        echo "Welcome to Depok Smart City";
    }

    public function check(){
        $token = $this->input->get_request_header('Authorization', TRUE);
        $data = new stdClass();
        if ($token != '') {
            
            $user = $this->mymodel->auth($token);


            if ($user->num_rows() == 1) {
                $data->status = true;
                $data->id = $user->row()->id;
            }else{
                $data->status = false;
                $data->message = "Invalid token";
            }
        }else{
                $data->status = false;
                $data->message = "Unauthenticated";
        }
        return $data;
    }

}
