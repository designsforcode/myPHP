<?php

include 'include_test.php';

$score = get_score( $_SESSION['ie'], $_SESSION['sn'], $_SESSION['ft'], $_SESSION['jp']);
?>
<html>
   <body>
      <form method='post' action="process.php">
         <input type="hidden" name="action" value="exit"/>
         <table border='1'>
            <tr><th>Assessment Test Results</th></tr>
            <tr>
               <td style="padding:16px">
                  Based on your answers to these questions, your score is as follows:<br/>
                  <div style="text-align:center;font-weight:bold"><a href="http://en.wikipedia.org/wiki/<?=$score?>" target="_blank"><?=$score?></a></div>
               </td>
            </tr>
            <tr>
               <td align="center"><input type="submit" value="Exit Application"/></td>
            </tr>
         </table>
      </form>
   </body>
</html>