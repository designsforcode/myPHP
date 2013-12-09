<?php

include 'include_test.php';

if(!isset($_POST['action'])){
   echo "Error! Cannot continue";
   exit;
}

$action=$_POST['action'];

switch($action){
   
   case 'start':
      
      // aray of questions
      $arr = array();
      for($i=0;$i<24;$i++) $arr[]=$i;
      
      // shuffle the questions
      shuffle($arr);
      
      $_SESSION['ie']=0;
      $_SESSION['sn']=0;
      $_SESSION['ft']=0;
      $_SESSION['jp']=0;
      $_SESSION['questions']=$arr;
      $_SESSION['current_set']=array();
      $_SESSION['setnum']=0;
      session_write_close();
      header("Location: test.php");
      
      break;
   case 'submit':
      
      // grade questions
      $error=false;
      $answers = @$_POST['answers'];
      
      if(!$answers ||count($answers)==0){
          $error=true;
      }
      
      // loop thorugh the current set
      $questions = $_SESSION['current_set'];
      if(!$questions || count($questions)==0){
         header("Location: results.php");
         exit;
      }
      
      for($i=0; $i<count($questions); $i++){
         if(!is_array($questions[$i])){
            // grade question!
            $qnum = $questions[$i];
            if(!isset($answers[$qnum]) || ($answers[$qnum]!='a' && $answers[$qnum]!='b')){
               // not answered!
               $error=true;
               
            } else {
               $a = $answers[$qnum];
               $m = ($a=='a') ? 1 : -1;
               $_SESSION['ie'] += $m * $test_questionA[$qnum][0];
               $_SESSION['sn'] += $m * $test_questionA[$qnum][1];
               $_SESSION['ft'] += $m * $test_questionA[$qnum][2];
               $_SESSION['jp'] += $m * $test_questionA[$qnum][3];
               $questions[$i] = array($qnum,$a);
            }
            
         }
      }
      
      // redirect to next set, error, or done
      if($error){
         // error screen
         $_SESSION['current_set']=$questions;
         session_write_close();
         header("Location: test.php?action=error");
      } else if(count($_SESSION['questions'])==0){
         // done!
         session_write_close();
         header("Location: results.php");
      } else {
         // next set
         $_SESSION['setnum']++;
         session_write_close();
         header("Location: test.php");
      }
      exit;
      break;
      
      
   case 'exit':
      $_SESSION['ie']=0;
      $_SESSION['sn']=0;
      $_SESSION['ft']=0;
      $_SESSION['jp']=0;
      $_SESSION['questions']=array();
      $_SESSION['current_set']=array();
      $_SESSION['setnum']=0;
      header("Location: index.php");
      exit;
      break;
      
   default:
      echo "Error! Unknown action";
      exit;
      break;
   
   
   
   
}

exit;





