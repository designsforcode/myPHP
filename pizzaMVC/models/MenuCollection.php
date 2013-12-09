<?php

class MenuCollection {
   
   
   private $_items=array();
   
   public function __construct(){
      $sql="SELECT * FROM a8_items";
      $query=DB::get()->prepare($sql);
      $query->execute();
      while($row=$query->fetch(PDO::FETCH_OBJ)){
         $this->_items[] = MenuFactory::make($row);
      }
   }
   
   public function toMenu(){
      $str='';
      foreach($this->_items as $item){
         $str.=$item->toMenu();
      }  
      return $str;
   }
   
   
   public function toEditTable(){
      $str='';
      foreach($this->_items as $menuItem){ 
         $str.= $menuItem->toTable();    
      }
      return $str;
   }
   
}