<?php

/**
 * This is to be used when you are NOT using composer where PSR4 is used to
 *  dynamically load the files when needed.
 *
 * This will load all files for this package.
 */

// Base Dependency for all of the Others
 require_once("Interfaces/EventImp.php");
 require_once("Request/Event.php");
 require_once("Interfaces/ObjectImp.php");
 require_once("Request/Object.php");

// Discord + Dependencies
 require_once("Endpoints/DiscordWebhook.php");
 require_once("Endpoints/DiscordPack/DiscordEmbeds.php");
 require_once("Endpoints/DiscordPack/objects/FooterObject.php");
 require_once("Endpoints/DiscordPack/objects/ThumbnailObject.php");
 require_once("Endpoints/DiscordPack/objects/FieldsObject.php");

// Slack + Dependencies
 require_once("Endpoints/SlackWebhook.php");
 require_once("Endpoints/SlackPack/SlackAttachments.php");

// Final Load
 require_once("WebhookCoordinator.php");


?>
