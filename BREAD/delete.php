<?php

include 'inc_functions.php';


if(!isset($_GET['id'])){
   echo "error, cannot find listing. <a href='index.php'>Click here to continue</a>";
   exit;
}

$id=intval($_GET['id']);

if(isset($_GET['delete']) && $_GET['delete'] == md5('d'.$id)){
   
   $sql="DELETE FROM listings WHERE id=$id LIMIT 1";
   $result=mysqli_query($db,$sql);
   
   header("Location:index.php?msg=deleted");
   exit;
}


?>
Are you sure you want to delete this listing? 
<br/><br/>
<a href='read.php?id=<?=$id?>'>No</a> | <a href='delete.php?id=<?=$id?>&delete=<?=md5('d'.$id)?>'>Yes</a>

