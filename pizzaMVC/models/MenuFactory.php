<?php

class MenuFactory {
   public static function make($data){
      if(is_numeric($data)){
         $sql="SELECT * FROM a8_items WHERE itemID=?";
         $query=DB::get()->prepare($sql);
         $query->execute(array($data));
         if($query->rowCount()>0){
            $data = $query->fetchObject();
         } 
      }
      if(is_object($data)){
         $type=$data->type;
         if($type=='pizza') return new MenuPizza($data);
         elseif($type=='drink') return new MenuDrink($data);
         else return new MenuItem($data);
      }
   }
   
}
