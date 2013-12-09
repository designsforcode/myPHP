<?php
session_start();
include ('inc_security.php');
$db = mysqli_connect('localhost', 'jbjarvis', $pass, 'jbjarvis');
$pass=null;

function is_valid_listing($data){
   
   $required = array('address','zip','asking_price','status');
   foreach($required as $f){
      if(!array_key_exists($f, $data)) return false;
      if($data[$f]=='') return false;
   }
   if(!in_array($data['status'], array('listed', 'pending', 'sold', 'unlisted'))) return false;
   if(!is_numeric($data['zip'])) return false;
   $price = str_replace("$",'',$data['asking_price']);
   $price = str_replace(",",'',$price);
   if(!is_numeric($price)) return false;
   
   return true;
}