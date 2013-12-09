<?php

include 'inc_functions.php';

$sql="SELECT * FROM listings ORDER BY asking_price DESC";
$data = mysqli_query($db,$sql);

?>
<table border='1'>
   <tr>
      <th>Address</th>
      <th>zip</th>
      <th>Bed</th>
      <th>Baths</th>
      <th>Sq. Ft.</th>
      <th>Price</th>
      <th>Built</th>
      <th>Lakefront</th>
      <th>Status</th>
   </tr>
   <?php while($row=mysqli_fetch_assoc($data)){ ?>
   <tr>
      <td><a href='read.php?id=<?=$row['id']?>'><?=stripslashes($row['address'])?></a></td>
      <td><?=$row['zip']?></td>
      <td><?=$row['num_bedrooms']?></td>
      <td><?=$row['num_baths']?></td>
      <td><?=$row['square_feet']?></td>
      <td>$<?=number_format($row['asking_price'],2)?></td>
      <td><?=$row['year_built']?></td>
      <td><?=($row['is_lakefront']=='y')?'Yes':'No'?></td>
      <td><?=ucfirst($row['status'])?></td>
   </tr>
   <?php } ?>
   
</table>

<a href='add.php'>Add Listing</a>