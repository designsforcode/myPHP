<?php


class MenuToppingCollection implements IteratorAggregate {
   
   private $_data=array();
   
   public function __construct(){
      
      // load all toppings
      $sql="SELECT * FROM a8_toppings ORDER BY toppingName";
      $query=DB::get()->query($sql);
      while($obj=$query->fetchObject('MenuTopping')){
         $this->_data[]=$obj;
      }
      
   }
   
   public function getIterator(){
      return new ArrayIterator($this->_data);
   }
   
}
