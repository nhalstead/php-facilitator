<?php

/**
* Example Slack
*
* This will Send an Event Created by the SlackWebhook
*  and send it by calling the Static function in WebhookCoordinator to Send the Single Event.
*
* This Example Connects to Slack and Sends a Message.
*/

require_once("../src/WebhookCoordinator_load.php"); //Without Composer
//require_once("../vendor/autoload.php"); //With Composer

use nhalstead\WebhookCoordinator;
use nhalstead\Endpoints\SlackWebhook;

// Create a New Event
$newEvent = new SlackWebhook("[SLACK WEBHOOK URL]");
$newEvent->message("Hello From the Other Side!");

// Start a Queue Worker
// Add the New Event to The Queue
$queue = new WebhookCoordinator();
$queue->addEvent($newEvent);
$queue->sendEvents();


// Print Debug Trace
print_r($queue->debugLog);

?>
