<?php

require_once("../src/WebhookCoordinator_load.php"); //Without Composer
//require_once("../vendor/autoload.php"); //With Composer

use nhalstead\WebhookCoordinator;

require_once("CustomEventTwo.php"); // Load the Custom Event

$e = new CustomEventTwo("myS3cr3tc0d3");
$e->message("Message")->tts_toggle();

// Send the Message short hand.
WebhookCoordinator::sendStat($e);

?>
