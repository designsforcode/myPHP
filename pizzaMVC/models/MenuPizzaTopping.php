<?php


class MenuPizzaTopping {
   
   public $toppingID;
   public $toppingName;
   public $price;
   
   public function __toString(){
      return $this->toppingName;
   }
   
}