<?php

/**
* Example 5
*
* This will call the IFTTT Secret URL by a just the Secret Key and the Event.
* This Event can have upto 3 values, value1, value2, value3.
* To set the Values you can call the function value1 etc to set the value.
*
*/

require_once("../vendor/autoload.php");

use nhalstead\Facilitator\Facilitator;
use nhalstead\Facilitator\Endpoints\IFTTTWebhook;

// Create a New Event
$newEvent = new IFTTTWebhook("[WEBHOOK Secret]", "[Event]");
$newEvent->value1("Testing");

// Call Worker to Send a Single Event
Facilitator::sendStat($newEvent);

?>
