<?php

class MenuDrink extends MenuItem {
   protected $_type='drink';
   
   public function __get($k){
      if($k=='price'){
         $p = $this->_data->price;
         $str = $p.' / '.($p+0.2).' / '.($p+0.4);
         return $str;
      } else return parent::__get($k);
   }
   
}
