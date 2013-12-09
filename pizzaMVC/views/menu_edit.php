<?php
include ('inc_header.php');

?>
<h2>Edit Menu</h2>
<table border='1'>
   <tr>
      <th>Title</th><th>Type</th><th>Toppings</th><th>Price</th><th>Options</th>
   </tr>
   <?php echo $menuCollection->toEditTable(); ?>
</table>
<br/>
<a href='menu/add'>Add Item</a>


