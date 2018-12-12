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
use nhalstead\Endpoints\DiscordPack\DiscordEmbeds;
use nhalstead\Endpoints\DiscordPack\objects\FooterObject;
use nhalstead\Endpoints\DiscordPack\objects\ThumbnailObject;
use nhalstead\Endpoints\DiscordPack\objects\FieldsObject;

// Create a New Event
$newEvent = new DiscordWebhook("[DISCORD WEBHOOK URL]");
$newEvent->username("John");
$newEvent->avatar("https://png.icons8.com/clouds/50/000000/megaphone.png");

$newEvent->addEmbed(
  DiscordEmbeds::new()->set("title", "New User joined GitOdin!")
    ->addEmbed("thumbnail", ThumbnailObject::new()
      ->set("url", "https://png.icons8.com/color/80/000000/face-id.png")
    )
    ->addEmbed("footer", FooterObject::new()
      ->set('text', "ID# 137899")
    )
    ->addEmbed("fields", FieldsObject::new()
      ->add(array(
        "name" => "Name",
        "value" => "John",
        "inline" => true
      ))
      ->add(array(
        "name" => "Date",
        "value" => "09/03/2018",
        "inline" => true
      ))
    )
);

// TODO: Fix Functions to be add_footer( FooterObject )
//       add_thumbnail( ThumbnailObject )
//       add_field( FieldObject )
//       add_author()
//       Maybe make it so you say new_field()->title("Hello"), Simple and Easy Rather Than
//        add_field( new FieldObject()->title("Some Title") )

// Call Worker to Send a Single Event
WebhookCoordinator::sendStat($newEvent);

?>
