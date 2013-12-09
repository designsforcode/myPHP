<?php

include 'inc_functions.php';

if(!isset($_GET['id'])){
   echo "error, cannot find listing. <a href='index.php'>Click here to continue</a>";
   exit;
}

$id=intval($_GET['id']);
$sql="SELECT * FROM listings WHERE id=$id";
$data = mysqli_query($db,$sql);
if(mysqli_num_rows($data)!=1){
   echo "error, cannot find listing. <a href='index.php'>Click here to continue</a>";
   exit;
}
$row=mysqli_fetch_assoc($data);
 
?>
<a href='index.php'>&laquo;Listing</a> | <a href='edit.php?id=<?=$id?>'>Edit</a> | <a href='delete.php?id=<?=$id?>'>Delete</a>
<hr/>
<table border='1'>
   <tr>
      <td>Address:</td>
      <td><?=stripslashes($row['address'])?></td>
   </tr>
   <tr>
      <td>Zip Code:</td>
      <td><?=$row['zip']?></td>
   </tr>
   <tr>
      <td>Bedrooms:</td>
      <td><?=$row['num_bedrooms']?></td>
   </tr>
   <tr>
      <td>Baths:</td>
      <td><?=$row['num_baths']?></td>
   </tr>
   <tr>
      <td>Size:</td>
      <td><?=$row['square_feet']?> sq.ft.</td>
   </tr>
   <tr>
      <td>Asking Price:</td>
      <td>$<?=number_format($row['asking_price'],2)?></td>
   </tr>
   <tr>
      <td>Year Built:</td>
      <td><?=$row['year_built']?></td>
   </tr>
   <tr>
      <td>Lakefront?:</td>
      <td><?=($row['is_lakefront']=='y')?'Yes':'No'?></td>
   </tr>
   <tr>
      <td>Status:</td>
      <td><?=ucfirst($row['status'])?></td>
   </tr>
   <tr>
      <td>Description:</td>
      <td><?=stripslashes($row['description'])?></td>
   </tr>
   
</table>