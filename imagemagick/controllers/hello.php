<?php

class Hello {
   
   
   public function world(){
      
      View::setTemplate('hello_template');
      
      $this->today = date('n/j/Y');
      
   }
   
   
   
}