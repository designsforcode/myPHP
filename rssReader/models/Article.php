<?php

class Article {
   
   private $data;
   private $search;
   
   public function __construct($node, $observer, $search){
      $this->data = $node;
      $str = $node->title.$node->description;
      if(strpos($str, $search)!==false){
         // string is here
         $observer->trigger($this);
         $this->search = $search;
      }
      
   }
   
   public function toHeadline(){
      return $this->data->title;
   }
   
   public function toFullString(){
      $str = '<h3>'.$this->data->title.'</h3>';
      $str .= strip_tags($this->data->description);
      $str = str_ireplace($this->search,'<span class="hl">'.$this->search.'</span>',$str);
      return $str;
   }
   
}