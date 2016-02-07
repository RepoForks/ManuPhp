<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class welcome extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mainmodel');
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        //$this->load->view('gcm');
        //  $this->load->database();

        $query = $this->db->query("SELECT * FROM test;");
        $ncount = $query->num_rows();
        echo $ncount . "</br>";
        //while ($query)


        for ($i = 0; $i < $ncount; $i++) {
            echo $i . "</br>";
            echo var_dump($query->row($i));
        }
        //   echo var_dump($query->result());


    }

    public function recycler()
    {
        // $id = $this->input->get('userid');
        // $key = $this->input->get('key');
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        //  $veersion = $this->input->get('version');

        $limit = $end;


        //$data= $_POST['hi'];

        $query = $this->Mainmodel->getData($start, $limit);

        $mm = Array();
        $i = 0;

        if ($query->num_rows() > 0) {


            foreach ($query->result_array() as $row) {

                $id = $row['U_Id'];
                $name = $row['U_FirstName'];

                $mm[$i] = Array("id" => $id, "name" => $name);
                $i++;


            }
            $user = Array("users" => $mm);
            echo json_encode($user);
        }


        //echo $id." ".$key." ".$start." ".$end." ".$veersion;
    }


    public function gcm()
    {

        $this->load->view('gcm');
    }

    public function registerUser()
    {

        $data = $this->input->post('data');

        $mdata = json_decode($data);
        $email = $mdata->U_Email;


        $user = $this->Mainmodel->isUserRegistered($email);
        $message = null;

        if ($user != null) {
            $message = "User Exist Please Login";
        } else {
            $this->Mainmodel->insertUser($mdata);
            $message = "User Registered Successfully";
        }
        $responce = array("message" => $message);
        echo json_encode($responce);

    }


    public function login()
    {
        $email=$this->input->post('email');
        $pass=$this->input->post('password');
        $user = $this->Mainmodel->isUserRegistered($email);
        $message=null;
        $data=null;
        if($user!=null) {
            $data = $this->Mainmodel->validateUser($email, $pass);
            if($data!=null){
                $message="Logged In Successfully";
            }else{
                $message="Incorrect Password";
            }
        }else{
            $message="User not Registered";
        }

        $responce = array("message" => $message,"User"=>$data);
        echo json_encode($responce);
    }

    public function getUsers()
    {
        $userId=$this->input->get('userId');
        $query = $this->Mainmodel->getUsers($userId);

        $status = 0;
        if ($query->num_rows() > 0) {
            // echo var_dump($query->result_array());
            $status = 1;
        }
        $responce = array("status" => $status, "users" => $query->result_array());
        echo json_encode($responce);
    }


    public function getUser()
    {
        $userId=$this->input->get('userId');
        $query = $this->Mainmodel->getUser($userId);

        $status = 0;
        if ($query->num_rows() > 0) {
            // echo var_dump($query->result_array());
            $status = 1;
        }
        $responce = array("status" => $status, "user" => $query->row_object());
        echo json_encode($responce);
    }
}
