<?php include('inc_header.php'); ?>
<h2>Missing Pet : Add/Edit</h2>

<a href='pets/details/<?=$pet->id?>'>Details</a>
<br/><br/>
<form method='post' action='pets/edit_submit/<?=$pet->id?>'>
<table border='1'>
   <tr>
      <td>Name</td>
      <td><input type='text' name='petData[petName]' maxlength='64' size='24' value='<?=$pet->petName?>'/></td>
   </tr>
    <tr>
      <td>Species</td>
      <td><input type='text' name='petData[species]' maxlength='24' size='24' value='<?=$pet->species?>'/></td>
   </tr>
    <tr>
      <td>Missing From</td>
      <td><input type='text' name='petData[missingFrom]' maxlength='24' size='24' value='<?=$pet->missingFrom?>'/></td>
   </tr>
    <tr>
      <td>Date Missing</td>
      <td><input type='text' name='petData[dateMissing]' maxlength='10' size='10' value='<?=$pet->dateMissing?>'/></td>
   </tr>
    <tr>
      <td>Reward</td>
      <td><input type='text' name='petData[reward]' maxlength='10' size='10' value='<?=$pet->reward?>'/></td>
   </tr>
    <tr>
      <td>Description</td>
      <td><textarea name='petData[description]' rows='5' cols='24'><?=$pet->description?></textarea></td>
   </tr>
    <tr>
      <td>Dangerous?</td>
      <td>
         <input type='radio' name='petData[isDangerous]' value='n' <?=($pet->isDangerous!='y')?'checked="checked"':''?>/> No <br/>
         <input type='radio' name='petData[isDangerous]' value='y' <?=($pet->isDangerous=='y')?'checked="checked"':''?>/> Yes
      </td>
   </tr>
    <tr>
      <td>Contact (Phone)</td>
      <td><input type='text' name='petData[contactPhone]' maxlength='16' size='24' value='<?=$pet->contactPhone?>'/></td>
   </tr>
    <tr>
      <td>Contact (Email)</td>
      <td><input type='text' name='petData[contactEmail]' maxlength='24' size='24' value='<?=$pet->contactEmail?>'/></td>
   </tr>
   <tr>
      <td>&nbsp;</td>
      <td><input type='submit' value='Submit'/></td>
   </tr>
   
</table>
</form>