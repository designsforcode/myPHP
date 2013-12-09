<?php

class pets {
   
   
   
   public function listing($msg=null){
      $this->msg=$msg;
      $this->petListing = new PetListing();
      View::setTemplate('pets_listing');
   }
   
   public function details($id){
      $this->pet = new PetItem($id);
      View::setTemplate('pets_details');
   }
   
   public function edit($id){
      $this->pet = new PetItem($id);
      View::setTemplate('pets_edit');
   }
   
   public function delete($id){
      $sql="DELETE FROM a10_pets WHERE id=? LIMIT 1";
      $query = DB::get()->prepare($sql);
      $query->execute(array($id));
      redirect('pets/listing/deleted');
   }
   
   public function edit_submit($id=null){
      $pet = new PetItem($id);
      $fields = $_POST['petData'];
      foreach($fields as $k=>$v){
         $pet->$k=$v;
      }
      $pet->save();
      redirect('pets/details/'.$pet->id);
   }
   
   public function add(){
      $this->pet = new PetItem();
      View::setTemplate('pets_edit');
   }
   
   /**
    * display the XML feed
    */
   public function feed(){
      
      $this->petListing = new PetListing();
      View::setTemplate('pets_feed');
      
   }
   
   
}