<?php

class MenuPizza extends MenuItem {
   protected $_type='pizza';
   protected $_toppings=array();
   
   public function __construct($data=null){
      parent::__construct($data);
      // load toppings
      if($data){
         $sql="SELECT t.* FROM a8_toppings t LEFT JOIN a8_item_toppings i ON i.toppingID=t.toppingID WHERE i.itemID=?";
         
         $query=DB::get()->prepare($sql);
         $query->execute(array($this->_itemID));
         while($row=$query->fetchObject('MenuPizzaTopping')){
            $this->_toppings[]=$row;
         }
         
      }
   }
   
   
   public function __get($k){
      if($k=='toppings'){ 
         // return the toppings list
         return implode(", ",$this->_toppings);
      } elseif($k=='price'){
         $p = $this->_data->price;
         foreach($this->_toppings as $topping){
            $p+=$topping->price;
         }
         return $p;
      } else return parent::__get($k);
   }
   
   public function __set($k,$v){
      if($k=='toppings'){ 
         if(is_array($v)){
            $this->_toppings = $v;
         }
      } else parent::__set($k,$v);
      
   }
   
   
   public function save($db){
      parent::save($db);
      foreach($this->_toppings as $id){
         $sql="INSERT INTO a8_item_toppings SET itemID=?, toppingID=?";
         $query=$db->prepare($sql);
         $query->execute(array($this->_itemID,$id));
      }
   }
   
   public function getMenuExtra(){
      return '<em>Topped with: '.$this->toppings.'</em>';
   }
   
   
}
