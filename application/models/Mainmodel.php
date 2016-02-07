<?php
/**
 * Created by PhpStorm.
 * User: mohan
 * Date: 5/2/16
 * Time: 5:21 PM
 */

 class mainModel extends CI_Model{

     function __construct()
     {
         parent::__construct();

     }
     public function simple(){
         return  $this->db->query("SELECT * FROM Users LIMIT 1,2;");
     }

     public function getData($start,$limit){
         //return  $this->db->get("test",2);
         return  $this->db->query("SELECT * FROM Users LIMIT ".$start.",".$limit.";");
     }

     public function getUsers($except){
         $this->db->where("U_Id !=",$except);
         $query= $this->db->get("Users");
         return $query;
     }
     public function getUser($id){
         return $this->db->query("SELECT * FROM Users WHERE U_Id=".$id.";");
     }

     public function insertUser($user){
         return $this->db->insert("Users",$user);
     }

     public function isUserRegistered($email){

         $this->db->where("U_Email",$email);
      $query=   $this->db->get("Users");
         return $query->row_object();

     }
     public function validateUser($email,$pass){
         $this->db->where("U_Email",$email);
         $this->db->where("U_Password",$pass);
         $query=   $this->db->get("Users");
         return $query->row_object();
     }


 }

?>