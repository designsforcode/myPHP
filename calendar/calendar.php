<?php

/**
 * Calendar Class Definitions
 */


class Calendar
{
   
   private $days=array();
   private $startDate;
   private $monthNum;
   private $yearNum;
   
   public function __construct($m, $y){
      $this->monthNum=$m;
      $this->yearNum=$y;
      $this->startDate = mktime(0,0,0,$m,1,$y);
      $daysNum = date('t',$this->startDate);
      for($d=1; $d <= $daysNum; $d++){
         $this->days[] = new CalendarDay($d);
      }
      
   }
   
   /**
    * Add an event to the calendar
    * @param type $ev
    */
   public function addEvent($ev){
      if(date('m',$ev->timestamp)==$this->monthNum){
         if(date('Y',$ev->timestamp)==$this->yearNum){
            $d = date('j',$ev->timestamp);
            $this->days[$d-1]->addEvent($ev);
         }
      }
   }
   
   
   public function toTable(){
      
      $dow = date('w',$this->startDate);
      
      $str = "<table class='cal'><tr><th colspan='7'>".date('F Y',$this->startDate)."</th></tr><tr><th>Sun</th><th>Mon</th><th>Tues</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr><tr>";
      for($i=0; $i < $dow; $i++){
         $str .= "<td class='out'>&nbsp;</td>";
      }
      foreach($this->days as $d){
         if($dow==7){
            $str.="</tr><tr>";
            $dow=0;
         }
         
         $str .= $d->toTableCell();
         
         $dow++;
      }
      for($i=$dow; $i < 7; $i++){
         $str .= "<td class='out'>&nbsp;</td>";
      }
      
      $str .="</table>";
      return $str;
   }
   
   
   
}

class CalendarDay
{
   
   public $dayNum;
   private $events=array();
   
   public function __construct($dayNum){
      $this->dayNum = $dayNum;
   }
   
   /**
    * add Event to day
    * Note: I'm not soritng the events until later
    * @param type $event
    */
   public function addEvent($event){
      $this->events[]=$event;
   }
   
   
   public function toTableCell(){
      
      // sort events
      $sorton = function($a,$b){
         if($a->timestamp > $b->timestamp) return 1;
         elseif($a->timestamp < $b->timestamp) return -1;
         else return 0;
      };
      usort($this->events,$sorton);
      
      $str = "<td>".$this->dayNum;
      
      foreach($this->events as $ev){
         
         $str.= "<br/>".date('g:ia',$ev->timestamp).": ".$ev->label;
         
      }
      
      
      $str .="</td>";
      return $str;
      
   }
   
   
   
}




class CalendarEvent
{
   
   public $timestamp;
   public $label;
   
   public function __construct($time, $label){
      $this->timestamp = strtotime($time);
      $this->label = $label;
      
   }
   
   
}


