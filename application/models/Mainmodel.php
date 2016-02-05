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
         return 'hi';
     }



 }

?>