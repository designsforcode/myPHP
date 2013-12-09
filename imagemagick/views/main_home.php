<html>
   <head>
      <BASE HREF='http://<?=PROJECT_URL?>'/>
      <style>
         .error {
            color: #900;
            border: 3px solid #900;
            padding: 6px;
            margin: 10px;
            background-color: #FFEEEE;
         }
         table tr td {
            padding: 4px;
            vertical-align: top;
         }
      </style>
   </head>
   <body>
      
      <?php if($error){ 
         
         echo "<div class='error'>".$error."</div>";
         
      }
      
      if($showImage){ 
         
         ?>
      <h3>Here is your photo...</h3>
      <img src='main/image'/>
      <?php /*<img src='resources/results/<?=$_SESSION['tmp_filename']?>.png'/>*/ ?>
      <hr/>
      <h3>Try another?</h3>
      
         <?php
         
         
      } else {
         
      echo "<h3>Photo filters!</h3>";
      
      } ?>
      
      <form method='post' enctype="multipart/form-data" action='main/process'>
         <table border='1'>
            <tr>
               <td>Select a Photo</td>
               <td><input type='file' name='img'/></td>
            </tr>
            <tr>
               <td>Select filter</td>
               <td>
                 <?php
                 $arr=array('Charcoal Effect','Poster Effect', 'Twirl Effect', 'Emboss');
                 for($i=0;$i < count($arr); $i++){
                    if($i>0) echo "<br/>";
                    $sel = ($i==0) ? 'checked="checked"':'';
                    echo "<input type='radio' name='filter' value='".$i."' $sel/> ".$arr[$i];
                 }
                 ?>
               </td>
            </tr>
            <tr>
               <td>Process Photo</td>
               <td><input type='submit' value='Go!'/></td>
            </tr>
         </table>
      </form>
      
      
      
      
   </body>
</html>