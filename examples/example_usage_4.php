<?php

/**
* Example 4
*
* In this example you will see that it is using CURL to get the Current value
*  of Bitcoin and post the USD and GBP value followed by posting it to the
*  channel that the Webhook is attached to.
*
**/

require_once("../vendor/autoload.php");

use nhalstead\Facilitator\Facilitator;
use nhalstead\Facilitator\Endpoints\DiscordWebhook;
use nhalstead\Facilitator\Endpoints\DiscordPack\DiscordEmbeds;
use nhalstead\Facilitator\Endpoints\DiscordPack\Objects\FieldsObject;

// Create a New Event
$newEvent = new DiscordWebhook("[DISCORD WEBHOOK URL]");
$newEvent->username("Service Bot");
$newEvent->avatar("https://img.icons8.com/color/96/000000/bot.png");

$d = get_json('https://api.coindesk.com/v1/bpi/currentprice.json');

// Add in the Embed Element to the Message.
$newEvent->addEmbed(
  DiscordEmbeds::new()->set("title", "Bitcoin Value")
    // Add a FieldObject that can contain a Name, Value as well as if its inline.
    ->addEmbed("fields", FieldsObject::new()
        ->add(array(
          "name" => "USD Value",
          "value" => "$".$d['bpi']['USD']['rate'],
          "inline" => true
        ))
        ->add(array(
          "name" => "British Pound Value",
          "value" => "£".$d['bpi']['GBP']['rate'],
          "inline" => true
        ))
    )
);

// Call Worker to Send a Single Event
Facilitator::sendStat($newEvent);


/**
 *** Dependency Function to make the Example Operate ***
 */

/**
 * This is a Test Function for Testing
 *
 * @param string $url Web Address to Request the Data from.
 * @return bool|mixed Json Data or False, Failed to Request or not 200 Response Code
 */
 function get_json($url = null){
   if($url == null){
     return false;
   }

   $handle = curl_init();
   curl_setopt_array($handle, array(
     CURLOPT_URL  => $url,
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_SSL_VERIFYHOST => false,
     CURLOPT_SSL_VERIFYPEER => false
   ));

   $data = curl_exec($handle);
   if(curl_getinfo($handle, CURLINFO_HTTP_CODE) !== 200){
     return false;
   }
   curl_close($handle);
   return json_decode($data, true);
 }

?>
