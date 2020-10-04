<?php

/**
* Example 3
*
* This will Send an Event Created by the DiscordWebhook
*  and send it by calling the Static function in WebhookCoordinator to Send
*  the Single Event, THis example also has access to add Embeds to the Message
*  by including the Embed element and adding the objects to each of the Embeds,
*  as needed.
*
*/

require_once("../vendor/autoload.php");

use nhalstead\Facilitator\Facilitator;
use nhalstead\Facilitator\Endpoints\DiscordWebhook;
use nhalstead\Facilitator\Endpoints\DiscordPack\DiscordEmbeds;
use nhalstead\Facilitator\Endpoints\DiscordPack\Objects\FooterObject;
use nhalstead\Facilitator\Endpoints\DiscordPack\Objects\ThumbnailObject;

// Create a New Event
$newEvent = new DiscordWebhook("https://discordapp.com/api/webhooks/xyz");
$newEvent->username("Service Bot");
$newEvent->avatar("https://img.icons8.com/color/96/000000/bot.png");

// Add in the Embed Element to the Message.
$newEvent->addEmbed(
  (new DiscordEmbeds)->set("title", "New Activity!")
    ->addThumbnail((new ThumbnailObject)->set("url", "https://img.icons8.com/color/128/000000/installing-updates.png"))
    ->addFooter((new FooterObject)->set('text', "Status Update from Server #237"))
    // Add a FieldObject that can contain a Name, Value as well as if its inline.
    ->addFields([
        array(
          "name" => "RAM Usage",
          "value" => "95%",
          "inline" => true
        ),
        array(
          "name" => "CPU Usage",
          "value" => "40%",
          "inline" => true
        ),
        array(
          "name" => "Pool Tag",
          "value" => "Pool A",
          "inline" => true
        ),
        array(
          "name" => "Activity",
          "value" => "New User Migrated to the Server",
          "inline" => false
        )
    ])
);

// Call Worker to Send a Single Event
Facilitator::sendStat($newEvent);

?>
