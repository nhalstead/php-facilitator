<?php

require_once("../src/WebhookCoordinator_load.php"); //Without Composer
//require_once("../vendor/autoload.php"); //With Composer

use nhalstead\Request\Event;
use nhalstead\Interfaces\EventImp;

/**
 * Custom Event Two
 * This is to show how to make your own Event and Have it so you just have to Pass
 *  the Secret Key and it will put it in with the root of the full URL.
 * @NOTE This is used as an Example in the Wiki for "Making your own Events"
 */
class CustomEventTwo extends Event implements EventImp {

  /**
   * Default Payload
   */
  public $payloadBase = [
    "username" => null, // Default Username value in the Payload that will be sent.
    "content" => "", // String Data
    "tts" => false // Text To Speech
  ];

  /**
   * Call Parent with the Basic Payload Layout.
   */
  public function __construct(string $key){
    $url = "https://gittesting.requestcatcher.com/webhooks/publish/" . $key;
    parent::__construct($url, $this->payloadBase);
  }

  /**
   * Toggle the Value for the Text to Speech
   *
   * @return CustomEventTwo Returns Instance of Self.
   */
  public function tts_toggle(){
    $this->payload['tts'] = !$this->payload['tts'];
    return $this;
  }

  /**
   * Set the Message Content
   *
   * @param String The Message Content
   * @return CustomEventTwo Returns Instance of Self.
   */
  public function message(string $message = null){
    $this->payload['content'] = $message;
    return $this;
  }
}

?>
