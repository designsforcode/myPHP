<?php

session_start();

$statesA = array('AL'=>"Alabama",    
			'AZ'=>"Arizona",  
			'AR'=>"Arkansas",  
			'CA'=>"California",  
			'CO'=>"Colorado",  
			'CT'=>"Connecticut",  
			'DE'=>"Delaware",  
			'DC'=>"District Of Columbia",  
			'FL'=>"Florida",  
			'GA'=>"Georgia",   
			'ID'=>"Idaho",  
			'IL'=>"Illinois",  
			'IN'=>"Indiana",  
			'IA'=>"Iowa",  
			'KS'=>"Kansas",  
			'KY'=>"Kentucky",  
			'LA'=>"Louisiana",  
			'ME'=>"Maine",  
			'MD'=>"Maryland",  
			'MA'=>"Massachusetts",  
			'MI'=>"Michigan",  
			'MN'=>"Minnesota",  
			'MS'=>"Mississippi",  
			'MO'=>"Missouri",  
			'MT'=>"Montana",
			'NE'=>"Nebraska",
			'NV'=>"Nevada",
			'NH'=>"New Hampshire",
			'NJ'=>"New Jersey",
			'NM'=>"New Mexico",
			'NY'=>"New York",
			'NC'=>"North Carolina",
			'ND'=>"North Dakota",
			'OH'=>"Ohio",  
			'OK'=>"Oklahoma",  
			'OR'=>"Oregon",  
			'PA'=>"Pennsylvania",  
			'RI'=>"Rhode Island",  
			'SC'=>"South Carolina",  
			'SD'=>"South Dakota",
			'TN'=>"Tennessee",  
			'TX'=>"Texas",  
			'UT'=>"Utah",  
			'VT'=>"Vermont",  
			'VA'=>"Virginia",  
			'WA'=>"Washington",  
			'WV'=>"West Virginia",  
			'WI'=>"Wisconsin",  
			'WY'=>"Wyoming");




$stateStr='';
$error=false;

// session data

$homeState = @$_SESSION['homeState'];
$stateList = @$_SESSION['stateList'];
if(!is_array($stateList)) $stateList=array();

// views
if(isset($_REQUEST['action'])){
   
   $action = $_REQUEST['action'];
   
   switch($action){
      
      case 'set_home_state':
         
         ?>
         <form method='post' action='index.php?action=set_home_state2'>
            Select Home State:<br/>
            <?php foreach($statesA as $a=>$s){
               $checked=($a==$homeState)?'checked="checked"':'';
               echo "<input type='radio' name='state' value='$a' $checked/> $s <br/>";
            } ?>
            <input type='submit' value='Go'/>
         </form>

         <?php
         exit(0);
         break;
         
      case 'set_home_state2':
         
         $state=@$_REQUEST['state'];
         if(array_key_exists($state, $statesA)){
            $_SESSION['homeState']=$state;
            session_write_close();
         }
         header("Location: index.php");
         exit;
         break;
         
      case 'remove_state':
         
         $state=@$_REQUEST['state'];
         if(in_array($state, $stateList)){
            $_SESSION['stateList'] = array_diff($stateList,array($state));
            session_write_close();
         }
         header("Location: index.php");
         exit;
         break;
            
      case 'add_states':
         
         ?>
         <form method='post' action='index.php?action=add_states2'>
            Select 3-6 States:<br/>
            <?php foreach($statesA as $a=>$s){
               $checked=(in_array($a, $stateList))?'checked="checked"':'';
               echo "<input type='checkbox' name='states[]' value='$a' $checked/> $s <br/>";
            } ?>
            <input type='submit' value='Go'/>
         </form>

         <?php
         exit(0);
         break;
         
      case 'add_states2':
         
         $states = $_POST['states'];
         $stateList = array();
         if(is_array($states)){
            foreach($states as $s){
               if(array_key_exists($s, $statesA) && !in_array($s, $stateList)){
                  $stateList[]=$s;
               }
            }
            $_SESSION['stateList']=$stateList;
            session_write_close();
         }
         header("Location: index.php");
         exit;
         break;
         
      case 'reset':
         
         $_SESSION['homeState']='';
         $_SESSION['stateList']=array();
         session_write_close();
         header("Location: index.php");
         exit;
         break;
      
   }
   
   
   
   
   
   
}



// ready to display?
if($homeState != '' && count($stateList) >= 3 && count($stateList)<=6){
   
   $stateStr = $homeState.','.implode(',',$stateList);
   $url = "http://russet.wccnet.edu/~jbjarvis/CPS276/api/locations.php?apikey=fred&states=".$stateStr;
   $result=file_get_contents($url);
   $data = @json_decode($result, true);
   
   
   if(@$data['distance']){
      
      
   } else {
      // error!
      $error="Service unavailable. Please try again later.";
      
   }
   
}

if($homeState != '' && count($stateList)>0 && count($stateList)<3){
   $error = "Not enough states! Please select more.";
}
if($homeState != '' && count($stateList)>6 ){
   $error = "Too many states! Please remove some.";
}

?>
<style>
.error { text-align:center; font-weight: bold; color: #900;}   
</style>
<table border='1' cellspacing='0' cellpadding='5'>
   <tr>
      <td valign='top'>
         <h3>Trip Planner</h3>
         <?php if($error) echo "<div class='error'>$error</div>"; ?>
         
         
         <table border='1' cellspacing='0' cellpadding='5'>
            <tr>
               <td colspan='2'>This application calculates the shortest route through various states.</td>
            </tr>
            <tr>
               <td width='90'>Home State:</td>
               <td>
                  <?php if($homeState!=''){
                     echo $statesA[$homeState]." [<a href='index.php?action=set_home_state'>change</a>]";
                  } else {
                     echo "[<a href='index.php?action=set_home_state'>Select home state</a>]";
                  } ?>
               </td>
            </tr>
             <tr>
               <td valign='top'>Other States:</td>
               <td>
                  <table cellspacing='1' cellpadding='0' border='0'>
                     <?php foreach($stateList as $s){ ?>
                     <tr>
                        <td><?=$statesA[$s]?></td>
                        <td>[<a href='index.php?action=remove_state&state=<?=$s?>'>x</a>]</td>
                     </tr>
                     <?php } if($homeState!=''){ ?>
                     <tr>
                        <td colspan='2'>
                           [<a href='index.php?action=add_states'>add/modify states</a>]
                        </td>
                     </tr>
                     <?php } ?>
                     
                  </table>
               </td>
            </tr>
            
         </table>
         [<a href='index.php?action=reset'>reset</a>]
         
         <?php if($data && !$error){ ?>
   
         <table border='1' cellspacing='0' cellpadding='5' width='100%'>
            <tr>
               <th colspan='2'>Best Route</th>
            </tr>
            <tr>
               <th>Location</th>
               <th>Miles</th>
            </tr>
            <?php foreach($data['path'] as $node){ ?>
            <tr>
               <td><?=$statesA[$node['state']]?></td>
               <td><?=($node['distance']>0)?$node['distance']:'n/a'?></td>
            </tr>
            <?php } ?>
            <tr>
               <td colspan='2'>Total Distance: <?=$data['distance']?> miles</td>
            </tr>
         </table>
      
         <?php } ?>
         
         
         
      </td>
      <td valign='top'>
         <?php if($stateStr){ ?>
         <img src="mapimage.php?states=<?=$stateStr?>"/>
         <?php } else { ?>
         <img src="us_map.jpg"/>
         <?php } ?>
      </td>
      
   </tr>
   
</table>




