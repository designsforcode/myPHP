<?php include('inc_header.php'); ?>
<h2>Missing Pets Listings</h2>

<?php 




if($msg=='deleted') echo "<b>*** Entry Deleted ***</b><br/><br/>";

//echo highlight_string(print_r($petListing, true), true);

echo $petListing->draw(); ?>

<br/>
<a href='pets/add'>Add Entry</a> <a href='pets/feed' target='_blank'>View XML Feed</a>