<?php

class PetListing {
   
   private $_listing=array();
   
   public function __construct(){
      
      
      $sql="SELECT * FROM a10_pets";
      $query=DB::get()->query($sql);
      while($row=$query->fetchObject('PetItem')){
         $this->_listing[]=$row;
      }
      
   }
   
   public function draw(){
      $str="<table border='1'><tr><th>name</th><th>Species</th><th>Date Missing</th><th>Reward</th><th>Options</th></tr>";
      foreach($this->_listing as $pet){
         $str.= $pet->draw();
      }
      $str.="</table>";
      return $str;
   }
   
   
   public function toXML(){
      
      $dom = new DomDocument();
      $root=$dom->createElement('MissingPets');
      
      $genAt = $dom->createAttribute('generatedAt');
      $genAt->value=date('n/j/Y g:ia');
      $root->appendChild($genAt);
      
      $dom->appendChild($root);
      foreach($this->_listing as $pet){
         $root->appendChild($pet->toXML($dom));
      }
      return $dom->saveXML();
      
   }
   
   
}