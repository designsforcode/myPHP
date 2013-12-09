<?php

include 'include_test.php';

if(!isset($_SESSION['questions']) || count($_SESSION['questions'])==0){
   header("Location: results.php");
   exit;
}

?>
<html>
   <body>
      <form method='post' action="process.php">
         <input type="hidden" name="action" value="submit"/>
         <table border='1'>
            <tr><th>Assessment Test</th></tr>

<?php
if(isset($_GET['action']) && $_GET['action']=="error"){
   // there was an error!
   
   echo "<tr><td style='text-align:center; color:#900;'>Error: please answer all questions!</td></tr>";
   $questions = $_SESSION['current_set'];
   
   for($i=0; $i<count($questions);$i++){
      $qn = 6*$_SESSION['setnum'] + $i + 1;
      $qnum = $questions[$i];
      if(is_array($qnum)){
         echo "<tr><td>";
         echo create_question($qn, $qnum[0], false, $qnum[1]);
         echo "</td></tr>";
      } else {
         echo "<tr><td>";
         echo create_question($qn, $qnum, true);
         echo "</td></tr>";
      }
   }
   
   
   
} else {
   // pick 6 new questions
   if(count($_SESSION['questions'])< 6){
      $questions = $_SESSION['questions'];
      $_SESSION['questions'] = array();
   } else {
      $arr = $_SESSION['questions'];
      $questions = array_splice($arr, 0, 6);
      $_SESSION['questions'] = $arr;
   }
   $_SESSION['current_set']=$questions;
   
   for($i=0; $i<count($questions);$i++){
      
      $qn = 6*$_SESSION['setnum'] + $i + 1;
      echo "<tr><td>";
      echo create_question($qn, $questions[$i], true);
      echo "</td></tr>";
   }
   
   
   
   
}



?>
            <tr>
               <td align="center">
                  <input type="submit" value="<?=(count($_SESSION['questions'])==0)?'Score Test':'Next Questions'?>"/>
               </td>
            </tr>
         </table>
      </form>
      
   </body>
</html>