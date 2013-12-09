<?php

// location mapping API

/* input must be: 
      apikey=name
 *    states=csv state abbrevs
 */
set_time_limit(120);
$db = mysqli_connect('localhost', $username, $password, $database);

if(!isset($_REQUEST['apikey'])){
   echo "Error: API key required";
   exit;
}

if(!isset($_REQUEST['states'])){
   echo "Error: States required";
   exit;
}

$states=$_REQUEST['states'];
$states = preg_replace("/[^A-Z,]*/","",$states);
@$statesA=explode(',',$states);
$statesA=array_unique($statesA);
if(count($statesA)<4){
   echo "Error: At least 4 states must be selected";
   exit;
}
if(count($statesA)>7){
   echo "Error: No more than 7 states can be selected";
   exit;
}

// cache check: is this done already?
$sortArray=$statesA;
sort($sortArray);
$cacheKey = md5(implode("",$sortArray));
$sql="SELECT * FROM api_cache WHERE cacheKey='$cacheKey'";
$rs_cache=mysqli_query($db,$sql);
if(mysqli_num_rows($rs_cache)>0){
   $row=mysqli_fetch_assoc($rs_cache);
   $data = stripslashes($row['cacheValue']);
   echo $data;
   exit(0);
}

$pool = new StatePool($db);
foreach($statesA as $st){
   $result = $pool->addState(trim($st));
   if(!$result){
      echo "Error: Unknown state: ".$st;
      exit;
   }
}

$pool->calculate();
$output = json_encode($pool->toArray());

// add to database
$dt = date('Y-m-d H:i:s');
$sql="INSERT INTO api_cache SET cacheKey='$cacheKey', cacheValue='".addslashes($output)."', created='$dt'";
$result=mysqli_query($db, $sql);

echo $output;
exit(0);


class StatePool {
   
   private $db;
   private $firstState=null;
   private $pool=array();
   
   private $bestRoute;
   private $totalDistance;
   
   public function __construct($db){
      $this->db=&$db;
      
   }
   
   public function addState($abbrev){
      
      $sql="SELECT * FROM api_states WHERE stateAbbrev='$abbrev' LIMIT 1"; 
      $rs_state=mysqli_query($this->db, $sql);
      if(mysqli_num_rows($rs_state)==1){
         $data = mysqli_fetch_assoc($rs_state);
         if($this->firstState==null){
            $this->firstState = new StateObj($data);
         } else {
            $this->pool[] = new StateObj($data);
         }
         return true;
      } else {
         return false;
      }
   }
   
   // brute force calculations
   public function calculate(){
      $this->bestRoute = new RouteFinder(0, $this->firstState, $this->pool);
      $this->bestRoute->measure(0);
      $this->totalDistance = $this->bestRoute->filter();
   }
   
   public function toArray(){
      $arr = array();
      $arr['distance'] = $this->totalDistance;
      $arr['path']=$this->bestRoute->flatten();
      return $arr;
   }
   
}


class StateObj {
   
   public $stateName;
   public $stateAbbrev;
   public $lat;
   public $long;
   public $x;
   public $y;
   
   public function __construct($data){
      $this->stateName = $data['stateName'];
      $this->stateAbbrev = $data['stateAbbrev'];
      $this->lat = $data['latitude'];
      $this->long = $data['longitude'];
      $this->x = $data['locX'];
      $this->y = $data['locY'];
   }
   
   public function getDistanceTo($state){
      return round(69.0 * sqrt((($this->lat - $state->lat)*($this->lat - $state->lat)) + (($this->long - $state->long)*($this->long - $state->long))),1);
   }
   
   
   
}
 

class RouteFinder {
   
   
   public $anchor;
   public $routes=array();
   public $nodeDistance=0;
   public $totalDistance=0;
   public $bestIndex;
   
   public function __construct($parent, $anchor, $nodes=null){ 
      if(is_object($parent)) $this->nodeDistance = $parent->anchor->getDistanceTo($anchor);
      $this->anchor=$anchor; 
      
     
      if(is_array($nodes) && count($nodes)>0){
         $c=count($nodes);
         for($i=0; $i<$c; $i++){
            $arr = $nodes; 
            $node = array_splice($arr,$i,1);
            $this->routes[]= new RouteFinder($this, $node[0], $arr);
         }
      }
   }
   
   public function measure($dist){
      $this->totalDistance = $dist + $this->nodeDistance;
      foreach($this->routes as $route){
         $route->measure($this->totalDistance);
      }
   }
   
   
   public function filter(){
      // filter down to the shortest run
      if(count($this->routes)==0){
         return $this->totalDistance;
      }
      $s = 999999;
      for($i=0; $i < count($this->routes); $i++){
         $f = $this->routes[$i]->filter();
         if($f < $s){
            $s = $f;
            $this->bestIndex = $i; 
         }
      }
      return $s;
   }
   
   
   public function flatten(){
      $arr = array('state'=>$this->anchor->stateAbbrev, 'x'=>$this->anchor->x, 'y'=>$this->anchor->y, 'distance'=>$this->nodeDistance);
      if($this->bestIndex !== null){
         $flatA = $this->routes[$this->bestIndex]->flatten();
         array_unshift($flatA, $arr);
         return $flatA;
      } else {
         $flatA = array($arr);
         return $flatA;
      }
   }
   
   
}



