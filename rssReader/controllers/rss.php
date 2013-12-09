<?php

class rss {
   
   public $url = 'rss.slashdot.org/Slashdot/slashdot';
   public $search = 'security';
   public $results = array();
   public $error='';
   
   public function reader(){
      View::setTemplate('rss_reader');
      if(isset($_POST['url']) && isset($_POST['search'])){
         
         $this->url = $_POST['url'];
         $this->search = preg_replace("/[^a-zA-Z0-9 \-\.\?]*/",'',$_POST['search']);
         
         if(substr($this->url,0,5)!='http:'){
            $this->url = 'http://'.$this->url;
         }
         
         $data = @file_get_contents($this->url);
         if(!$data){
            $this->error = "Invalid URL";
         } else {
            
            $this->observer = new ArticleObserver();
            $array = new SimpleXMLElement($data);
            //echo highlight_string(print_r($array, true), true);
            $items = $array->channel->item;
            foreach($items as $item){
               $this->results[] = new Article($item, $this->observer, $this->search);
            }
            
         }
         
         
      }
      
   }
   
}
