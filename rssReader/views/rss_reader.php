<html>
   <head>
      <BASE HREF='http://<?=PROJECT_URL?>'/>
      <style>
         .hl {
            background-color: #FF0;
         }
      </style>   
   </head>
   <body>
     
      <h3>RSS Reader/Observer</h3>
      <form method='post' action='rss/reader'>
         RSS Feed URL: <input type='text' size='50' value='<?=htmlentities($url)?>' name='url'/>
         <br/>
         Search String: <input type='text' size='15' value='<?=htmlentities($search)?>' name='search'/>
         <input type='submit' value='Go'/>
      </form>
      <hr/>
      <?php
      if($error != ''){
         echo $error.'<hr/>';
      } elseif(count($results)>0){
         
         echo "Articles with keyword: ".$observer->count()."<br/>";
         echo $observer->toOutput();
         echo "<hr/>";
         echo "Full headlines:<br/><br/>";
         foreach($results as $article){
            echo $article->toHeadline().'<br/>';
         }
         
      }
      ?>
      
   </body>
</html>