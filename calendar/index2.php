<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<a href='index.php'>Index</a> Index2 <a href='index3.php'>Index3</a>
<hr/>
<?php

// -------------------------------------
// DO NOT MAKE ANY CHANGES TO THIS FILE!
// -------------------------------------

include('calendar.php');

// new calendar for April 2013
$calendar = new Calendar(4, 2013); 

// add a single event (off-month)
$event = new CalendarEvent('2013-03-14 10:00:00','Office Party');
$calendar->addEvent($event);

// add Saturday Class
$calendar->addEvent(new CalendarEvent('2013-04-06 9:00:00','PHP Class'));
$calendar->addEvent(new CalendarEvent('2013-04-13 9:00:00','PHP Class'));
$calendar->addEvent(new CalendarEvent('2013-04-20 9:00:00','PHP Class'));
$calendar->addEvent(new CalendarEvent('2013-04-27 9:00:00','PHP Class'));

// busiest day ever
for($h = 22; $h >= 6; $h--){
   $event = new CalendarEvent('2013-04-10 '.$h.':00:00', 'Meeting');
   $calendar->addEvent($event);
}


echo $calendar->toTable();

