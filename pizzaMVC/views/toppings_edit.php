<?php
include ('inc_header.php');
//echo highlight_string(print_r($menuTopping, true), true);
?>
<h2>Add/Edit Topping</h2>

<form method='post' action='toppings/edit_submit/<?=$menuTopping->toppingID?>'>
   <table border='1'>
      <tr>
         <td>Name</td>
         <td><input type='text' size='24' name='toppingName' value='<?=htmlentities($menuTopping->toppingName)?>'/></td>
      </tr>
      <tr>
         <td>Price</td>
         <td>$<input type='text' size='10' name='price' value='<?=($menuTopping->price!==null)?number_format($menuTopping->price,2):''?>'/></td>
      </tr>
      <tr>
         <td>&nbsp</td>
         <td><input type='submit' value='Submit'/></td>
      </tr>
      
   </table>
</form>