<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<a href='index.php'>Index</a> <a href='index2.php'>Index2</a> Index3
<hr/>
<?php

// -------------------------------------
// DO NOT MAKE ANY CHANGES TO THIS FILE!
// -------------------------------------

include('calendar.php');

// new calendar for September 2013
$calendar = new Calendar(9, 2013); 

$labels = array('Shopping', 'Naptime', 'Oil Change', 'Wash Hair', 'Soccer Game', 'Shred Documents', 'Pay Bills', 'Watch TV', 'Tea Time', 'Gardening', 'Loiter', 'Band Practice', 'Gala Dinner', 'Chop Firewood');

// fill calendar with an assortment of random events
for($d=1; $d <= 30; $d++){
   for($h = 7; $h <= 21; $h++){
      $time = '2013-09-'.$d.' '.$h.':'.rand(0,59).':00';
      $event = new CalendarEvent($time, $labels[rand(0,count($labels)-1)]);
      $calendar->addEvent($event);
   }
}

echo $calendar->toTable();

