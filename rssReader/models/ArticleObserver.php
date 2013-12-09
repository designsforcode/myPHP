<?php

class ArticleObserver {
   
   private $articles=array();
   
   public function trigger(Article $article ){
      
      $this->articles[]=$article;
      
   }
   
   public function count(){
      return count($this->articles);
   }
   
   public function toOutput(){
      $str = '';
      foreach($this->articles as $article){
         $str.=$article->toFullString().'<br/>';
      }
      return $str;
   }
   
}
