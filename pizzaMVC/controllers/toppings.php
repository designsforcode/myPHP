<?php

class Toppings {
   
   
   public function listing(){
      View::setTemplate('toppings_list');
      $this->toppingList = new MenuToppingCollection();
      
   }
   
   
   public function add(){
      $this->menuTopping = new MenuTopping();
      $this->editMode=false;
      View::setTemplate('toppings_edit');
   }
   
   public function edit($id){
      $this->menuTopping = new MenuTopping($id);
      $this->editMode=true;
      View::setTemplate('toppings_edit');
      
   }
   
   public function edit_submit($id=null){
      
      $topping = new MenuTopping($id);
      $topping->toppingName = $_REQUEST['toppingName'];
      $topping->price = $_REQUEST['price'];
      $topping->save();
      redirect('toppings/listing');
   }
   
   public function delete($id){
      
      $topping = new MenuTopping($id);
      if($topping->canDelete()){
         $topping->delete();
         redirect('toppings/listing');
      } else {
         throw new Exception("Cannot delete topping in use!");
      }
      
   }
   
   
   
}