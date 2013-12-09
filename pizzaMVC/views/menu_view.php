<?php
include ('inc_header.php');

?>
<h2>Our menu</h2>
<div class='menu'>
<?php 

echo $menuCollection->toMenu();


?>
</div>
   </body>
</html>
