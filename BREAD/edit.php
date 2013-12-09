<?php

include 'inc_functions.php';

if(!isset($_GET['id'])){
   echo "error, cannot find listing. <a href='index.php'>Click here to continue</a>";
   exit;
}
$error=false;
$id=intval($_GET['id']);

if(isset($_POST['listing'])){
   
   $arr=array();
   $listing=$_POST['listing'];
   if(is_valid_listing($listing)){
      foreach($listing as $k=>$v){
         $v=addslashes($v);
         $arr[]= $k."='$v'";
      }
      $sql="UPDATE listings SET ".implode(',',$arr)." WHERE id=$id LIMIT 1";
      $result=mysqli_query($db,$sql);

      header("Location: read.php?id=$id");
      exit;
   } else {
      $row=$listing;
      $error=true;
   }
} else {

   $sql="SELECT * FROM listings WHERE id=$id";
   $data = mysqli_query($db,$sql);
   if(mysqli_num_rows($data)!=1){
      echo "error, cannot find listing. <a href='index.php'>Click here to continue</a>";
      exit;
   }
   $row=mysqli_fetch_assoc($data);
   
}
?>
<a href='read.php?id=<?=$id?>'>&laquo;Details</a>
<hr/>
<form method='post' action='edit.php?id=<?=$id?>'>
    <?php if($error){ ?>
   <div style='color:#900; font-weight:bold;'>Error! Some required fields were not completed!</div>
   <?php } ?>
<table border='1'>
   <tr>
      <td>Address*:</td>
      <td><input name='listing[address]' type='text' size='40' value='<?=htmlentities(stripslashes($row['address']))?>'/></td>
   </tr>
   <tr>
      <td>Zip Code*:</td>
      <td><input name='listing[zip]' type='text' size='5' maxlength='5' value='<?=$row['zip']?>'/></td>
   </tr>
   <tr>
      <td>Bedrooms:</td>
      <td><input name='listing[num_bedrooms]' type='text' size='3' value='<?=$row['num_bedrooms']?>'/></td>
   </tr>
   <tr>
      <td>Baths:</td>
      <td><input name='listing[num_baths]' type='text' size='3' value='<?=$row['num_baths']?>'/></td>
   </tr>
   <tr>
      <td>Size:</td>
      <td><input name='listing[square_feet]' type='text' size='6' value='<?=$row['square_feet']?>'/> sq.ft.</td>
   </tr>
   <tr>
      <td>Asking Price*:</td>
      <td>$<input name='listing[asking_price]' type='text' size='10' value='<?=($row['asking_price'])?>'/></td>
   </tr>
   <tr>
      <td>Year Built:</td>
      <td><input name='listing[year_built]' type='text' size='4' maxlength='4' value='<?=$row['year_built']?>'/></td>
   </tr>
   <tr>
      <td>Lakefront:</td>
      <td>
         <input type="radio" value='y' name='listing[is_lakefront]' <?=($row['is_lakefront']=='y')?'checked="checked"':''?>/> Yes<br/>
         <input type="radio" value='n' name='listing[is_lakefront]' <?=($row['is_lakefront']=='n')?'checked="checked"':''?>/> No
      </td>
   </tr>
   <tr>
      <td>Status*:</td>
      <td>
         <select name='listing[status]'>
            <option value='listed' <?=($row['status']=='listed')?'selected="selected"':''?>>Listed</option>
            <option value='pending' <?=($row['status']=='pending')?'selected="selected"':''?>>Pending</option>
            <option value='sold' <?=($row['status']=='sold')?'selected="selected"':''?>>Sold</option>
            <option value='unlisted' <?=($row['status']=='unlisted')?'selected="selected"':''?>>Unlisted</option>
         </select>
      </td>
   </tr>
   <tr>
      <td>Description:</td>
      <td><textarea name='listing[description]' cols='50' rows='6'><?=stripslashes($row['description'])?></textarea></td>
   </tr>
   
</table>
<input type='submit' value='Submit'/>
</form>
