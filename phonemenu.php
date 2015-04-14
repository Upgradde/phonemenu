<?php

// @start snippet
/* Define Menu */
$web = array();
$web['default'] = array('receptionist','hours', 'location', 'duck');
$web['location'] = array('receptionist','east-bay', 'san-jose', 'marin');

/* Get the menu node, index, and url */
$node = $_REQUEST['node'];
$index = (int) $_REQUEST['Digits'];
$url = 'http://'.dirname($_SERVER["SERVER_NAME"].$_SERVER['PHP_SELF']).'/phonemenu.php';

/* Check to make sure index is valid */
if(isset($web[$node]) || count($web[$node]) >= $index && !is_null($_REQUEST['Digits']))
	$destination = $web[$node][$index];
else
	$destination = NULL;
// @end snippet

// @start snippet
/* Render TwiML */
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><Response>\n";
switch($destination) {
	case 'hours': ?>
		<Say>Joey press is open Monday through Friday, 9am to 5pm</Say>
		<Say>Saturday, 10am to 3pm and closed on Sundays</Say>
		<?php break;
	case 'location': ?>
		<Say>Joey Press is located at 21650 Milsa Drive in San Antonio Texas</Say>
		<Gather action="<?php echo 'http://' . dirname($_SERVER["SERVER_NAME"] .  $_SERVER['PHP_SELF']) . '/phonemenu.php?node=location'; ?>" numDigits="1">
			<Say>For directions from the Austin, press 1</Say>
			<Say>For directions from San Bernny, press 2</Say>
		</Gather>
		<?php break;
	case 'east-bay': ?>
		<Say>Take Interstate Highway 10 West towards San Antonio. Exit Dominion Drive and take the turnaround. Turn right on Milsa.  We are right behind the Lexus deakership</Say>
		<?php break;
	case 'san-jose': ?>
		<Say>Take Interstate Highway 10 East</Say>
		<?php break;
	case 'duck'; ?>
		<Play>hello.mp3</Play>
		<?php break;
	case 'receptionist'; ?>
		<Say>Please wait while we connect you</Say>
		<Dial>NNNNNNNNNN</Dial>
		<?php break;
	default: ?>
		<Gather action="<?php echo 'http://' . dirname($_SERVER["SERVER_NAME"] .  $_SERVER['PHP_SELF']) . '/phonemenu.php?node=default'; ?>" numDigits="1">
			<Say>Hello and welcome to the Joey Press Phone Menu</Say>
			<Say>For business hours, press 1</Say>
			<Say>For directions, press 2</Say>
			<Say>To hear a duck quack, press 3</Say>
			<Say>To speak to a receptionist, press 0</Say>
		</Gather>
		<?php
		break;
}
// @end snippet

// @start snippet
if($destination && $destination != 'receptionist') { ?>
	<Pause/>
	<Say>Main Menu</Say>
	<Redirect><?php echo 'http://' . dirname($_SERVER["SERVER_NAME"] .  $_SERVER['PHP_SELF']) . '/phonemenu.php' ?></Redirect>
<?php }
// @end snippet

?>

</Response>
