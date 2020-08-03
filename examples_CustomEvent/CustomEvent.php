<?php

require_once("../src/WebhookCoordinator_load.php"); //Without Composer
//require_once("../vendor/autoload.php"); //With Composer

use nhalstead\Request\Event;
use nhalstead\Interfaces\EventImp;

/**
 * Custom Event
 * This is to show how to make your own Event.
 * @NOTE This is used as an Example in the Wiki for "Making your own Events"
 */
class CustomEvent extends Event implements EventImp {

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
  public function __construct(string $url){
    parent::__construct($url, $this->payloadBase);
  }

  /**
   * Toggle the Value for the Text to Speech
   *
   * @return CustomEvent Returns Instance of Self.
   */
  public function tts_toggle(){
    $this->payload['tts'] = !$this->payload['tts'];
    return $this;
  }

  /**
   * Set the Message Content
   *
   * @param String The Message Content
   * @return CustomEvent Returns Instance of Self.
   */
  public function message(string $message = null){
    $this->payload['content'] = $message;
    return $this;
  }
}

?>
