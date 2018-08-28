<?php

namespace nhalstead\Endpoints;

use nhalstead\Request\Event;
use nhalstead\Interfaces\EventImp;

/**
 * Discord Event
 *
 * @parent nhalstead\Request\Event
 * @link https://discordapp.com/developers/docs/resources/webhook#execute-webhook
 */
class DiscordWebhook extends Event implements EventImp {

  public $payloadBase = [
    "username" => null, /** Override the Username for the Message */
    "avatar_url" => null, /** Override Avatar URL for the Message */
    "content" => "", /** String Data */
    "tts" => false, /** Text To Speach */
    "file" => null, /** File Uploads */
    "embeds" => array() /** Embed Object */
  ];

  /**
   * Call Parent with the Basic Payload Layout.
   */
  public function __construct(string $url){
    parent::__construct($url, $this->payloadBase);
  }

  /**
   * Toggle the Value for the Text to Speach
   *
   * @return Discord Returns Instance of Self.
   */
  public function tts_toggle(){
    $this->payload['tts'] = !$this->payload['tts'];
    return $this;
  }

  /**
   * set the Name to use in the Message
   *
   * @param String The Name to Use when Adding the Message
   * @return Discord Returns Instance of Self.
   */
  public function username(string $name = null){
    $this->payload['username'] = $name;
    return $this;
  }

  /**
   * Set the Message Content
   *
   * @param String The Message Content
   * @return Discord Returns Instance of Self.
   */
  public function message(string $message = null){
    $this->payload['content'] = $message;
    return $this;
  }

  /**
   * Set the Icon Content
   *
   * @param String URL to the Image to Use for the Profile Picture.
   * @return Discord Returns Instance of Self.
   */
  public function avatar(string $url = null){
    $this->payload['avatar_url'] = $url;
    return $this;
  }


}

?>
