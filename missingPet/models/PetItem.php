<?php


class PetItem {
   
   private $_data=array();
   private $_errors=array();
   
   public function __construct($id=null){
      if(is_numeric($id)){
         $sql="SELECT * FROM a10_pets WHERE id=? LIMIT 1";
         $query=DB::get()->prepare($sql);
         $query->execute(array($id));
         if($query->rowCount()>0){
            $this->_data = $query->fetch(PDO::FETCH_ASSOC);
         }
      }
   }
   
   public function __get($k){
      if(array_key_exists($k,$this->_data)){
         if($k=='dateMissing'){
            $d=strtotime($this->_data['dateMissing']); 
            return ($d>0) ? date('n/j/Y',$d) : '';
         }
         return $this->_data[$k];
      }
      return null;
   }
   
   public function __set($k,$v){
      $arr = array('id','petName','species','missingFrom','dateMissing','reward','isDangerous','description',
                  'contactPhone','contactEmail');
      if(in_array($k,$arr)){
         switch($k){
            case 'dateMissing':
               if($v!='') $this->_data['dateMissing']=date('Y-m-d',strtotime($v));
               else $this->_errors[]='dateMissing';
               break;
               
            case 'id':
               if(@$this->_data['is']>0){
                  echo "error! pet object already created"; exit;
               }
               else $this->_data['id']=$v;
               break;
               
            default:
               $this->_data[$k]=$v;
            
         }
         if($k=='dateMissing' && $v!=''){
            $this->_data['dateMissing']=date('Y-m-d',strtotime($v));
         } else {
            
         }
      } else {
         // passing something illegal
         
      }
   }
   
   public function save(){
      
      if(@$this->_data['id']>0){
            // update!
            $arr=array();$arr2=array();
            foreach($this->_data as $key => $value){
                if($key!='id'){
                    $arr[]=$key.'=?';
                    $arr2[]=$value;
                }
            }
            $properties = implode(',',$arr);
            $sql="UPDATE a10_pets SET $properties WHERE id=".$this->_data['id'];
            
        } else {
            // insert
            $arr=array();$arr2=array();
            foreach($this->_data as $key => $value){
                if($key!='id'){
                    $arr[]=$key.'=?';
                    $arr2[]=$value;
                }
            }
            $properties = implode(',',$arr);
            $sql="INSERT INTO a10_pets SET $properties";
            
        }
        $query=DB::get()->prepare($sql);
        $query->execute($arr2);
        
        if(!$this->_data['id']){
            $this->_data['id'] = DB::get()->lastInsertId();
        }
      
      
   }
   
   
   public function draw(){
      $str = "<tr>";
      $str.="<td>".$this->petName."</td>";
      $str.="<td>".$this->species."</td>";
      $str.="<td>".$this->dateMissing."</td>";
      $str.="<td>".$this->reward."</td>";
       $str.="<td><a href='pets/details/".$this->id."'>View</a></td>";
      $str .="</tr>";
      return $str;
      
   }
   
   public function toXML($dom){
      
      $item = $dom->createElement('petEntry');
      
      $missingSince = $dom->createAttribute('missingSince');
      $missingSince->value = $this->dateMissing;
      $item->appendChild( $missingSince);
      
      if($this->isDangerous=='y'){
         $danger = $dom->createAttribute('dangerous');
         $danger->value='YES';
         $item->appendChild($danger);
      }
      
      $item->appendChild( $dom->createElement('name', $this->petName) );
      $item->appendChild( $dom->createElement('species', $this->species) );
      $item->appendChild( $dom->createElement('reward', $this->reward) );
      $item->appendChild( $dom->createElement('description', $this->description) );
      
      // contact methods
      $contactNode = $dom->createElement('contactMethods');
      $item->appendChild($contactNode);
      
      if($this->contactPhone) $contactNode->appendChild( $dom->createElement('phone', $this->contactPhone) );
      if($this->contactEmail) $contactNode->appendChild( $dom->createElement('email', $this->contactEmail) );
      
      //echo highlight_string(print_r($item, true), true); exit;
      
      return $item;
   }
   
   
}

