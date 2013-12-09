<?php

include 'include_functions.php';


?>
<html>
<body>
   <style>
      .error { color: #900; font-weight: bold; }
   </style>
   <!-- form section -->
   <form method='post' action='index.php'>
      <h5>Michigan Association of Veterinary Optometrists : Provider Lookup</h5>
      Enter MI zip code: <input type='text' maxlength='5' size='5' name='zipcode' value='<?=@$_REQUEST['zipcode']?>'/>
      <input type='submit' value='Go'/>
   </form>
   
   <!-- results section -->
   <?php
   
   if(isset($_REQUEST['zipcode'])){
     
      $zipcode = $_REQUEST['zipcode'];
      
      if(is_numeric($zipcode)){
         
         $zipcode = intval($zipcode);
         $sql="SELECT * FROM a5_locations WHERE zipcode=$zipcode LIMIT 1";
         $rs_location=mysqli_query($db,$sql);
         if(mysqli_num_rows($rs_location)==1){
            
            // echo data about this location
           $locationData = mysqli_fetch_assoc($rs_location);
           ?>
            <table border='1' cellspacing='0' cellpadding='5'>
               <tr>
                  <th colspan='2'>Location Data</th>
               </tr>
               <tr>
                  <td>Zip Code:</td>
                  <td><?=$locationData['zipcode']?></td>
               </tr>
                <tr>
                  <td>Location:</td>
                  <td><?=$locationData['location_name']?>, <?=$locationData['state']?></td>
               </tr>
               <tr>
                  <th colspan='2'>Nearby Providers</th>
               </tr>
               <tr>
                  <td colspan='2'>
                     <?php
                     
                     // find neaby providers
                     $distance = 25; // 50 miles
                     // 69 miles per degree
                     
                     $lat = $locationData['latitude'];
                     $long = $locationData['longitude'];
                     
                     $sql="SELECT p.provider_name, p.provider_number, l.location_name, l.state, l.zipcode,
                           (69*SQRT(POW(l.longitude - $long,2)+POW(l.latitude - $lat,2))) AS dist,
                           GROUP_CONCAT(c.clientele_label SEPARATOR ', ') AS clientele_list
                           FROM a5_locations l 
                           JOIN a5_providers p ON p.locationID=l.locationID
                           LEFT JOIN a5_provider_clientele pc ON pc.providerID=p.providerID
                           LEFT JOIN a5_clientele c ON c.clienteleID=pc.clienteleID
                           WHERE (69*SQRT(POW(l.longitude - $long,2)+POW(l.latitude - $lat,2))) <= $distance
                           GROUP BY p.providerID
                           ORDER BY SQRT(POW(l.longitude - $long,2)+POW(l.latitude - $lat,2)) ASC, p.provider_number";

                     
                     $rs_results = mysqli_query($db,$sql);
                     //echo $sql; echo mysqli_error($db);
                     
                     if(mysqli_num_rows($rs_results)==0){
                        echo "<div class='error'>No nearby providers found</div>";
                        
                     } else {
                        
                        echo "<table border='1' cellspacing='0' padding='2'>";
                        echo "<tr><th colspan='5'>".mysqli_num_rows($rs_results)." providers within $distance miles</th></tr>";
                        echo "<tr><th>Provider</th><th>Provider #</th><th>Clientele</th><th>Location</th><th>Distance</th></tr>";
                        while($row=mysqli_fetch_assoc($rs_results)){
                           echo "<tr>";
                           echo "<td>".$row['provider_name']."</td>";
                           echo "<td>".$row['provider_number']."</td>";
                           echo "<td>".$row['clientele_list']."</td>";
                           echo "<td>".$row['location_name'].", ".$row['state']." ".$row['zipcode']."</td>";
                           echo "<td>".number_format($row['dist'],1)."</td>";
                           echo "</tr>";
                        }
                        echo "</table>";
                        
                        
                     }
                     
                     ?>
                  </td>
               </tr>
            </table>
   
   
   
            <?php
            
            
            
         } else {
            echo "<div class='error'>Error: zip code not found</div>";
         }
         
      } else {
         echo "<div class='error'>Error: please enter a number</div>";
      }
      
   }
   ?>
   
   <br/>
   <img src='img05.png'/>
</body>
</html>