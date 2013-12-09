<?php
include ('inc_header.php');

echo "<h2>Toppings</h2>";

//echo highlight_string(print_r($toppingList, true), true);

echo "<table border='1'><tr><th>Name</th><th>Price</th><th>Options</th></tr>";
foreach($toppingList as $topping){
   
   echo $topping->toTable();
   
}
?>
</table>
<br/>
* Only unused toppings may be deleted
<br/><br/>
<a href='toppings/add'>Add Topping</a>