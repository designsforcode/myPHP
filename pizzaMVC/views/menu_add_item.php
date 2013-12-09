<?php
include('inc_header.php');

?>
<h2>Add New Item</h2>

<form name='addform' method='post' action='menu/add_submit'>
   Name of Item: <input type='text' name='add[title]' size='30'/><br/><br/>
   Base Price: $<input type='text' name='add[price]' size='7'/><br/><br/>
   Type: <br/>
   <input type='radio' name='add[type]' value='entree' checked='checked'/> Entree<br/>
   <input type='radio' name='add[type]' value='drink' /> Drink<br/>
   <input type='radio' name='add[type]' value='pizza' /> Pizza<br/>
   <div style='width:400px;margin-left:20px'>
   <?php foreach($toppings as $topping){ ?>
   <input type='checkbox' name='add[toppings][]' value='<?=$topping->toppingID?>'/> <?=$topping->toppingName?><br/>
   <?php } ?>
   </div>
   <br/>
   <input type='submit' value='Add'/>
</form>
