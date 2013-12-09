<?php

class main {
   
   public $showImage=false;
   public $error=false;
   
   public function __construct(){
      
      // generate a random string to use as a filename
      // for locally storing data
      if(!isset($_SESSION['tmp_filename'])) $_SESSION['tmp_filename']=md5(time().rand(1,999999));
   }
   
   
   public function home(){
      View::setTemplate('main_home');
   }
   
   public function process(){
      
      $image = new Image_Processor();
      $result = $image->processImage(@$_FILES['img']);
      if($result){
         // succeeded!
         redirect('main/results');
      } else {
         // failed!
         $this->error = $image->getError();
         View::setTemplate('main_home');
      }
      
   }
   
   
   public function results(){
      View::setTemplate('main_home');
      $this->showImage = true;
   }
   
   public function image(){
      // passthrough - present the image
      $file = SETTINGS::get()->project_dir.'resources/results/'.$_SESSION['tmp_filename'].'.png';
      if(file_exists($file)){
         header("Content-type: image/png");
         header("Cache-Control: no-cache, must-revalidate"); 
         header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
         echo file_get_contents($file);
      }
      
      exit(0);
   }
   
   
}