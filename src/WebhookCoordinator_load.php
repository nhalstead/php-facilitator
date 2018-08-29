<?php

/**
 * This is to be used when you are NOT using composer where PSR4 is used to
 *  dynamically load the files when needed.
 *
 * This will load all files for this package.
 */

 require_once("Interfaces/EventImp.php");
 require_once("Request/Event.php");
 require_once("Endpoints/DiscordWebhook.php");
 require_once("Endpoints/SlackWebhook.php");
 require_once("Endpoints/SlackPack/SlackAttachments.php");
 require_once("WebhookCoordinator.php");


?>
