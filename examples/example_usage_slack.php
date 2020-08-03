<?php

/**
* Example Slack
*
* This will Send an Event Created by the SlackWebhook
*  and send it by calling the Static function in WebhookCoordinator to Send the Single Event.
*
* This Example Connects to Slack and Sends a Message.
*/

require_once("../vendor/autoload.php");

use nhalstead\Facilitator\Facilitator;
use nhalstead\Facilitator\Endpoints\SlackWebhook;

// Create a New Event
$newEvent = new SlackWebhook("https://hooks.slack.com/services/xyz");
$newEvent->message("Hello From the Other Side!");

// Start a Queue Worker
// Add the New Event to The Queue
$queue = new Facilitator();
$queue->addEvent($newEvent);
$queue->sendEvents();

?>
