<?php

session_start();


/*
 *    Assessment Test Questions
 *    Each question follows the same format:
 * 
 *    array( $ie, $sn, $ft, $jp, $question, $answerA, $answerB )
 * 
 *    Each question impacts only one of the following variables: $ie, $sn, $ft, $jp   
 *    If the first answer is selected, apply the value
 *    If the second answer is selected, apply the value *-1
 *    
 *    Example:
 *       For the first question below, (-1, 0, 0, 0)
 *       If the first answer is selected, $ie = $ie - 1;
 *       if the second answer is selected, $ie = $ie + 1
 * 
 */

$test_questionA= array(
   array( -1, 0, 0, 0,	"At a social event I am more likely to interact with...",	"a few close friends",	"lots of friends or strangers"),
   array(  0, 0, 1, 0,	"During a crisis, I tend to...",	"stay calm",	"rely on my empathy"),
   array(  0, 0, 0, 1,	"I am more apt to...",	"try to please everyone",	"notice mistakes made by others"),
   array( 0, -1, 0, 0,	"I am more interested in...",	"what is real",	"possibilities"),
   array(  0, 1, 0, 0,	"I am more trusting of...",	"my gut instinct",	"what I have personally experienced"),
   array( 0, 0, -1, 0,	"I honestly think of myself as...",	"sensitive",	"thick-skinned"),
   array( -1, 0, 0, 0,	"I place a high value on...", "privacy",	"knowing everyone"),
   array(  0, 0, 0, 1,	"I prefer to go through life...",	"wherever life leads me",	"on a strict schedule"),
   array(  0, 0, 1, 0,	"I tend to make decisions based on...",	"measurable data",	"my feelings"),
   array( 0, -1, 0, 0,	"I would say that I am more...",	"pragmatic",	"idealistic"),
   array( 0, 0, -1, 0,	"In an argument, I usually...",	"compromise or look for common ground",	"stick to my position"),
   array( 0, 0, -1, 0,	"People respect me for...",	"my devotion to others",	"by ability to be reasonable"),    
   array(  1, 0, 0, 0,	"People think of me as...",	"easy to approach",	"reserved"),
   array(  0, 0, 0, 1,	"People who know me well regard me as...",	"an easy-going person",	"a serious person"),
   array( 0, 0, 0, -1,	"When a job is almost completed, I am more likely to...",	"work hard to finish",	"start something else"), 
   array(  1, 0, 0, 0,	"When conversing with someone...",	"I usually do the talking",	"I usually listen more"),
   array( -1, 0, 0, 0,	"When I receive a message from a casual acquaintance, I reply to it...",	"within a few days",	"immediately"),
   array( 0, -1, 0, 0,	"When I talk to someone, I tend to speak about...",	"specifics",	"things in general"),
   array( 0, 0, 0, -1,	"When making an important decision, I usually...",	"make up my mind quickly and be done",	"think things over for a long time"),
   array(  0, 0, 1, 0,	"When meeting new people, I tend to be...",	"objective",	"friendly"),
   array(  0, 1, 0, 0,	"When traveling to a place I've never been, I prefer to use...",	"my own internal map, I never get lost", 	"a GPS app or written directions"),
   array(  0, 1, 0, 0,	"When walking around in the world, I tend to feel...",	"removed from others",	"connected to everyone"),
   array( 0, 0, 0, -1,	"When working on a project, my goal is...",	"a complete, finished product",	"a better understanding of how it works"),
   array(  1, 0, 0, 0,	"With my colleagues at work/school,...",	"I tend to be talkative",	"I tend to say little")
);


function create_question($lnum, $qnum, $active=true, $value=null){
   // return HTML for a question
   global $test_questionA;
   
   $sela = $selb = '';
   if($value=='a') $sela = 'checked="checked"';
   if($value=='b') $selb = 'checked="checked"';
   $disInputStr = ($active) ? '' : 'disabled="disabled"';
   $str="";
   if($active==false) $str .= "<span style='color: #CCCCCC'>";
   $str.= "($lnum). ";
   $str.= $test_questionA[$qnum][4];
   $str.= "<div style='margin: 6px 0 6px 50px'><input type='radio' name='answers[$qnum]' value='a' $disInputStr $sela /> ".$test_questionA[$qnum][5]."</div>";
   $str.= "<div style='margin: 6px 0 6px 50px'><input type='radio' name='answers[$qnum]' value='b' $disInputStr $selb /> ".$test_questionA[$qnum][6]."</div>";
   if($active==false) $str .= "</span>";
   return $str;
   
}

function get_score( $ie, $sn, $ft, $jp){
   $str = '';
   $str .= ($ie < 0)?'I':'E';
   $str .= ($sn < 0)?'S':'N';
   $str .= ($ft < 0)?'F':'T';
   $str .= ($jp < 0)?'J':'P';
   return $str;
}