<?php

/**
* Example 1
*
* Create a new Event using the DiscordWebhook
* Create a New Queue or Buffer if you will,
* Followed by Adding the Event to the Queue and
*  sending what is in the Queue.
*
* The purpose of using a Queue is to allow many Events
*  to be added then sending all of the events at the end of the request.
* This plays into the method of add it to the list and do it latter
*  but latter is at the end of the request.
*/

require_once("../vendor/autoload.php");

use nhalstead\Facilitator\Facilitator;
use nhalstead\Facilitator\Endpoints\DiscordWebhook;

// Create a New Event
$newEvent = new DiscordWebhook("https://discordapp.com/api/webhooks/xyz");
$newEvent->username("John");
$newEvent->avatar("https://png.icons8.com/clouds/50/000000/megaphone.png");
$newEvent->message("Hello");

// Start a Queue Worker
// Add the New Event to The Queue
$queue = new Facilitator();
$queue->addEvent($newEvent);
$queue->sendEvents();

?>
