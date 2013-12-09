<?php

/**
 *		CPS 276 Winter 2012-- Assignment 01
 * 	Aquarium Cost Estimator
 */


		 
// Variables are identified with a dollar sign:
$a = 5;

// There is not need to specify a data type, and you can reassign variables to a different data type as needed...
$a = 1;				// integer
$a = "Kittens";	// string
$a = true;			// boolean
// ....but in general practice, if a variable is intended to be a number please keep it that way. 



// -------------------------------------------------------



// Your assignment is to calculate the following values...

$materials_cost = 0;		// cost of materials: glass, fish, water, etc
$labor_cost = 0;			// cost of putting it together
$total_cost = 0;			// the grand total
$time_required = 0;		// the total number of hours required
$total_fish = 0;			// total fish in a fully-stocked tank
$regular_fish = 0;
$fancy_fish = 0;

// here is the input... (no changes needed here)

$width = intval(@$_REQUEST['width']);
$height = intval(@$_REQUEST['height']);
$depth = intval(@$_REQUEST['depth']);


// you can set the following variable to a string, to report any errors at the end.
$error='';
// Example: $error='Width cannot be a negative number.';


// START WORKING HERE...

// Part 1: Materials Cost

/*		
		A. Start by finding the total surface area of the aquarium. Assume that the aquarium is glass on all six sides. Store this as $glass_surface. Hint: (W*H)*2 + (W*D)*2 + (H*D)*2
		B. Also find the total volume of the aquarium, and store as $total_volume. Assume the tank will be filled completely to the top.
		C. Raw materials cost: glass costs $0.03 per cm/sq. You could store this as a variable in case the price changes later.
		D. Raw materials cost: purified water costs $0.001 per cm/3.
		E. Each fish requires 150 cm/3 of space. Find the maximum number of fish that can fit in the tank. ** Hint: use the floor() function to round down.
		F. No more than 7% of the fish will be fancy fish ($1.78 each). There must be an even number of fancy fish. The rest will be regular fish ($0.59 each).
		G. Add a small castle and lighting: $7.95
*/


$glass_surface = ($width*$height)*2 + ($width*$depth)*2 + ($height*$depth)*2;
$total_volume = $width * $height * $depth;
$materials_cost += 0.03 * $glass_surface + 0.001 * $total_volume + 7.95;
$total_fish = floor($total_volume / 150);
$fancy_fish = floor($total_fish * 0.07); 
if($fancy_fish % 2) $fancy_fish--;
$regular_fish = $total_fish - $fancy_fish;

$materials_cost += $regular_fish * 0.59 + $fancy_fish * 1.78;


// Part 2: Time Required

/*
		The time required will be used to calculate the labor costs
		A. There are two times to keep track of: time to construct the tank ($tank_time) and time to stock the fish ($stock_time), both measured in minutes.
		B. For the tank time, use the FOR loop below.
			The first side always takes exactly 10 minutes to create.
			Each successive side takes two additional minutes per fancy fish than the previous side.
			Example: with 3 fancy fish, the times are: 10 + 16 + 22 + 28 + 34 + 40 = 150 minutes
		C. For the stocking time, use the WHILE loop below.
			Continue the loop until all fish are accounted for.
			In the first minute, one fish will be stocked.
			For each subsequent minute, twice as many fish are stocked as the last.
			Example, for 117 fish: 1, 2, 4, 8, 16, 32, 64, 128 --> 8 minutes needed
		D. Yes, there are other ways to calculate this, but use the loops provided. It's part of the assignment.
*/

$tank_time=0;
$stock_time=0;


// tank time
$t=10;
for($i = 0; $i < 6; $i++){
	
	// {add code here}
	$tank_time += $t;
	$t+= 2*$fancy_fish;
	
}


// stocking time
$stocked = 0; $inc=1; 
while($stocked < $total_fish){
	
	// {more code here}
	$stocked += $inc;
	$inc *=2;
	$stock_time++;
}

// Part 3: Labor Costs and Grand Total

/* 	A. The staff are aquarium professionals, paid $33.71 per hour or portion thereof. ** Hint: round up to the nearest hour with the ceil() function
		B. Add $12 handling fee.
		C. Calculate the grand total (materials and labor)
		D. There's a sale going on! If the total is greater than $250, give a 30% discount. If between $100-$249, give a 10% discount.
		E. Use the number_format function to alter the math precision for currency.
			Example: $amount = number_format($amount, 2);   -->  would turn 24.022278 into 24.02
*/

$time_required = ($tank_time + $stock_time) / 60;

$labor_cost = ceil($time_required) * 33.71 + 12;

$total_cost = $materials_cost + $labor_cost;

if($total_cost > 250) $total_cost *= 0.7;
elseif($total_cost > 100) $total_cost *= 0.9;

if($width==0 || $height==0 || $depth==0){
	$total_cost = $materials_cost = $labor_cost = $time_required = '';
} else {

	$total_cost = '$'.number_format($total_cost,2);
	$materials_cost = '$'.number_format($materials_cost,2);
	$labor_cost = '$'.number_format($labor_cost,2);
	$time_required = number_format($time_required,2);
}



/*		What follows is the HTML form used to present the application.
 		No changes are needed beyond this point, but it's a good idea to look this over.
 		You will be making your own forms in future assignments. */

echo $error;
?>
<form method='get' action='index.php'>
	<table border='1'>
		<tr>
			<th colspan='2'>Aquarium Cost Estimator</th>
		</tr>
		<tr>
			<td>Width</td>
			<td><input type='text' name='width' value='<?=@$_REQUEST['width']?>' size='5'/> cm</td>
		</tr>
		<tr>
			<td>Height</td>
			<td><input type='text' name='height' value='<?=@$_REQUEST['height']?>' size='5'/> cm</td>
		</tr>
		<tr>
			<td>Depth</td>
			<td><input type='text' name='depth' value='<?=@$_REQUEST['depth']?>' size='5'/> cm</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type='submit' value='Calculate'/></td>
		</tr>
		<tr>
			<th colspan='2'>Results</th>
		</tr>
		<tr>
			<td>Total Fish</td>
			<td><?php if($total_fish) echo $total_fish.' ('.$fancy_fish.' fancy)'; else echo '&nbsp;'?></td>
		</tr>
		<tr>
			<td>Materials Cost</td>
			<td><?=($materials_cost) ? $materials_cost: '&nbsp;'?></td>
		</tr>
		<tr>
			<td>Labor Cost</td>
			<td><?=($labor_cost) ? $labor_cost : '&nbsp;'?></td>
		</tr>
		<tr>
			<td>Total Cost</td>
			<td><?=($total_cost) ? $total_cost : '&nbsp;'?></td>
		</tr>
		<tr>
			<td>Time Required</td>
			<td><?=($time_required)?$time_required.' hours':'&nbsp;'?></td>
		</tr>
	</table>
</form>

