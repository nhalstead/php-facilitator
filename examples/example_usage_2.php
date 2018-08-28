<?php

/**
* Example 2
*
* This will Send an Event Created by the DiscordWebhook
*  and send it by calling the Static function in WebhookCoordinator to Send the Single Event.
*
* The purpos of using the ::sendStat method is to Send a single Request
*  with the least amount of code but does it all now, when it is called.
*/

require_once("../src/WebhookCoordinator_load.php"); //Without Composer
//require_once("../vendor/autoload.php"); //With Composer

use nhalstead\WebhookCoordinator;
use nhalstead\Endpoints\DiscordWebhook;

// Create a New Event
$newEvent = new DiscordWebhook("[DISCORD WEBHOOK URL]");
$newEvent->username("John");
$newEvent->avatar("https://png.icons8.com/clouds/50/000000/megaphone.png");
$newEvent->message("Hello");

// Call Worker to Send a Single Event
WebhookCoordinator::sendStat($newEvent);

?>
