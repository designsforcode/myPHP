<?php include('inc_header.php'); ?>
<h2>Missing Pet : Details</h2>

<a href='pets/listing'>Return to Listing</a>
<a href='pets/edit/<?=$pet->id?>'>Edit</a>
<a href='pets/delete/<?=$pet->id?>' onclick='return confirm("Are you sure you want to delete this entry?");'>Delete</a>
<br/><br/>
<table border='1'>
   <tr>
      <td>Name</td>
      <td><?=$pet->petName?></td>
   </tr>
    <tr>
      <td>Species</td>
      <td><?=$pet->species?></td>
   </tr>
    <tr>
      <td>Missing From</td>
      <td><?=$pet->missingFrom?></td>
   </tr>
    <tr>
      <td>Date Missing</td>
      <td><?=$pet->dateMissing?></td>
   </tr>
    <tr>
      <td>Reward</td>
      <td><?=$pet->reward?></td>
   </tr>
    <tr>
      <td>Description</td>
      <td><?=$pet->description?></td>
   </tr>
    <tr>
      <td>Dangerous?</td>
      <td><?=$pet->isDangerous?></td>
   </tr>
    <tr>
      <td>Contact (Phone)</td>
      <td><?=$pet->contactPhone?></td>
   </tr>
    <tr>
      <td>Contact (Email)</td>
      <td><?=$pet->contactEmail?></td>
   </tr>
   
</table>
