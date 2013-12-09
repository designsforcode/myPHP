<link rel="stylesheet" type="text/css" href="stylesheet.css" />
Index <a href='index2.php'>Index2</a> <a href='index3.php'>Index3</a>
<hr/>
<?php

// -------------------------------------
// DO NOT MAKE ANY CHANGES TO THIS FILE!
// -------------------------------------

include('calendar.php');

// create a new calendar for March 2013
$calendar = new Calendar(3, 2013); 

// add a single event
$event = new CalendarEvent('2013-03-14 10:00:00','Office Party');
$calendar->addEvent($event);

// add work shifts (every three days)
for($d=2; $d <= 31; $d+=3){
   $event = new CalendarEvent('2013-03-'.$d.' 9:30:00', 'Work');
   $calendar->addEvent($event);
}

// output as a table
echo $calendar->toTable();

