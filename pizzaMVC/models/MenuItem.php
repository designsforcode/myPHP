<?php


class MenuItem implements MenuPrintable {
   
   protected $_data;
   protected $_type='entree';
   protected $_itemID=0;
   
   public function __construct($data=null){
      if($data){ 
         $this->_data = $data;
         if($data->itemID) $this->_itemID=$data->itemID;
      } else $this->_data=new StdClass();
   }
   
   public function __get($k){
      if(@$this->_data->$k) return $this->_data->$k;
      return false;
   }
   
   public function __set($k,$v){
      if($k=='title'||$k=='price'){
         $this->_data->$k=$v;
      }
   }
   
   public function save($db){
      if($this->_itemID>0){
         // save changed
         $sql="UPDATE a8_items SET title=?, price=?, type=? WHERE itemID=?";
         $query=$db->prepare($sql);
         $query->execute(array($this->title, $this->price, $this->type, $this->_itemID));
      } else {
         // add as new record
         $sql="INSERT INTO a8_items SET title=?, price=?, type=?";
         $query=$db->prepare($sql);
         $query->execute(array($this->title, $this->price, $this->_type));
         $this->_itemID = $db->lastInsertId();
      }
   }
   
   public function toMenu(){
      
      $str="<div class='item'>";
      $str.="<b>{$this->title}</b><div class='right'>{$this->price}</div>";
      $str.=$this->getMenuExtra();
      $str.="</div>";
      return $str;
      
   }
   
   public function getMenuExtra(){
      return '';
   }
   
   public function toTable(){
      $str = "<tr><td>{$this->title}</td><td>{$this->_type}</td><td>{$this->toppings}&nbsp;</td><td>{$this->price}</td><td><a href='edit.php?action=delete&id={$this->itemID}'>x</a></td>";
      return $str;
   }
}
