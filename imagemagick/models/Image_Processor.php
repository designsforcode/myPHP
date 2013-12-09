<?php

class Image_Processor {
   
   private $_error=false;
   
   public function processImage($file=null){
      
      //echo highlight_string(print_r($file, true), true);
      //exit;
      /*
    [name] => kitten2.jpg
    [type] => image/jpeg
    [tmp_name] => /tmp/phphakeNx
    [error] => 0
    [size] => 45460
              */
      $filename = preg_replace("/[^a-zA-Z0-9\.]*/",'',$file['name']);
      $type = $file['type'];
      $tmp_name = $file['tmp_name'];
      $error = $file['error'];
      $size = $file['size'];
              
      // 1. was a file uploaded?
      if(!$file || !$file['name'] || !$file['tmp_name']){
         $this->_error = "No file selected";
         return false;
      }
      
      if($error>0 || $size==0){
         $this->_error = "File upload error. Please try again";
         return false;
      }
      
      if(!file_exists($tmp_name)){
         $this->_error = "File upload error. Server cannot upload file";
         return false;
      }
      
      // 2. is the file a valid type?
      $array = array("image/jpeg","image/png");
      if(!in_array($type, $array)){
         $this->_error = "Error: File type (".$type.") is not supported";
         return false;
      }
      
      // 3. could we move it to the tmp area?
      $src = SETTINGS::get()->project_dir.'resources/tmp/'.$filename;
      $dst = SETTINGS::get()->project_dir.'resources/results/'.$_SESSION['tmp_filename'].".png";
      if(file_exists($dst)) unlink($dst);
      $result = move_uploaded_file($tmp_name, $src);
      if(!$result){
         $this->_error = "Error: could not prepare file. Please try again later";
         return false;
      }
      
      // 4. apply the filter
      $filter_num = intval($_REQUEST['filter']);
      if($filter_num==1) $filter = "/usr/bin/convert $src -resize 500x500\> -unsharp 5 -colors 5 -quality 33 $dst";
      elseif($filter_num==2) $filter = "/usr/bin/convert $src -resize 500x500\> -swirl 75 -quality 33 $dst";
      elseif($filter_num==3) $filter = "/usr/bin/convert $src -resize 500x500\> -emboss 5 -quality 33 $dst";
      else $filter = "/usr/bin/convert $src -resize 500x500\> -charcoal 3 -quality 33 $dst";
      
      //echo $filter; exit;
      $result = exec($filter);
      
      // 5. was it successful?
      if(!file_exists($dst)){
         $this->_error = "Filter Error! Please try again later";
         return false;
      }
      
      // 6. done/store to db
      
      
      return true;
   }
   
   
   public function getError(){
      return $this->_error;
   }
   
   
}