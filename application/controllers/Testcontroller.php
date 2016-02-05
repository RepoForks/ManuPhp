<?php
/**
 * Created by PhpStorm.
 * User: mohan
 * Date: 1/2/16
 * Time: 5:51 PM
 */
class Testcontroller extends CI_Controller
{

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
        $this->load->database();

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

    public function gcm()
    {

        $this->load->view('gcm');
    }
    public function mar(){
       $data= array("marquee"=>"enabled");
       echo  json_encode($data);
    }

    public function test()
    {





        $this->load->view('test');
    }
}
?>