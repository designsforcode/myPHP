<?php

class menu {
   
   public function __construct(){
      
      
   }
   
   
   public function display(){
      View::setTemplate('menu_view');
      $this->menuCollection = new MenuCollection();
   }
   
   
   
   public function edit(){
      View::setTemplate('menu_edit');
      $this->menuCollection = new MenuCollection();
      
      
   }
   
   
   public function add(){
      View::setTemplate('menu_add_item');
      $this->toppings = new MenuToppingCollection();
   }
   
   public function add_submit(){
      
      $fields = $_POST['add'];
      $type=$fields['type'];
      if($type=='entree') $obj=new MenuItem();
      if($type=='drink') $obj=new MenuDrink();
      if($type=='pizza') $obj=new MenuPizza();
      
      if(@$obj){
         foreach($fields as $k=>$v){
            if($k!='type') $obj->$k = $v;
         }
         $obj->save(DB::get());
         
      }
      
      redirect('menu/edit');
      
      
   }
   
   public function delete_item($id){
      
      $sql="DELETE FROM a8_items WHERE itemID=?";
      $query=DB::get()->prepare($sql);
      $query->execute(array($id));
      redirect('menu/edit');
      
   }
   
   
}
