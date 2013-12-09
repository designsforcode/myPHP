<?php

include 'col_data.php';


?>
<html>
   <form method='post' action='index.php'>
      
      <table border='1' cellpadding='4'>
         
         <tr>
            <th colspan='2'>Cost of Living Calculator</th>
         </tr>
         
         <tr>
            <td colspan='2'>
               This application compares the relative cost of living between two locations.
            </td>
         </tr>
         
         <tr>
            <td>Location A:</td>
            <td><select name='loc_a'><option value=''>(select a location)</option>
         <?php
         
         foreach($COL_array as $name=>$value){
            $sel = (@$_REQUEST['loc_a']==$name) ? 'selected="selected"':'';
            echo "<option value='$name' $sel>$name</option>";
         }
         
         ?>
      </select></td>
         </tr>
         <tr>
            <td>Wages in Location A:</td>
            <td>$ <input type='text' name='wages_a' value='<?=@htmlentities($_REQUEST['wages_a'])?>' size='8'/><br/>
            </td>
         </tr>
         
         <tr>
            <td>Location B:</td>
            <td><select name='loc_b'><option value=''>(select a location)</option>
         <?php
         
         foreach($COL_array as $name=>$value){
            $sel = (@$_REQUEST['loc_b']==$name) ? 'selected="selected"':'';
            echo "<option value='$name' $sel>$name</option>";
         }
         ?>
         
         </select></td></tr>
         
         <tr><td>&nbsp;</td>
            <td>
      <input type='submit' value='calculate wages'/>
            </td>
         </tr>
      </table>
   </form>
   
   <?php
   
   
   if(isset($_REQUEST['loc_a']) && isset($_REQUEST['loc_b']) && isset($_REQUEST['wages_a'])){
     
      echo "<hr/>";
      
      $loc_a = $_REQUEST['loc_a'];
      $loc_b = $_REQUEST['loc_b'];
      $wages_a = $_REQUEST['wages_a'];
      $wages_a = str_replace('$','',$wages_a);
      $wages_a = str_replace(',','',$wages_a);
      $wages_a = floatval($wages_a);
      if($wages_a > 0 && $loc_a != '' && $loc_b !=''){
      
         $adj1 = @$COL_array[$loc_a];
         $adj2 = @$COL_array[$loc_b];
         $wages_b = ($wages_a / $adj1) * $adj2;
         
         $wages_a = number_format($wages_a,2);
         $wages_b = number_format($wages_b,2);
         
         $loc_a = substr($loc_a,4);
         $loc_b = substr($loc_b,4);
         
         echo "Making <b>$".$wages_a."</b> in $loc_a is the same as making <b>$".$wages_b."</b> in $loc_b.";
      
      } else {
         
         
         echo "Error: <br/>";
         if($wages_a<=0) echo "cannot determine wages<br/>";
         if($loc_a=='' || $loc_b=='') echo "please select locations";
      }
   }
   
   ?>
   
   
   
</html>