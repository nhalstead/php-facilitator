<?php

namespace nhalstead\Endpoints;

use nhalstead\Request\Event;
use nhalstead\Interfaces\EventImp;

/**
 * IFTTT Webhook
 *
 * Goto the Link below and click on "Documentation".
 * @link https://maker.ifttt.com/use/
 */
class IFTTTWebhook extends Event implements EventImp {

  /**
   * Default Payload
   */
  public $payloadBase = [
  ];

  /**
   * Call Parent with the Basic Payload Layout and the Secret and Event Name.
   */
  public function __construct(string $secret, string $event){
    $url = "https://maker.ifttt.com/trigger/".$event."/with/key/".$secret;
    parent::__construct($url, $this->payloadBase);
  }

  /**
   * Set value1 in the Payload of the Event
   *
   * @param String The Message Content
   * @return IFTTTWebhook Returns Instance of Self.
   */
  public function value1(string $value){
    $this->payload["value1"] = $value;
    return $this;
  }

  /**
   * Set value2 in the Payload of the Event
   *
   * @param String The Message Content
   * @return IFTTTWebhook Returns Instance of Self.
   */
  public function value2(string $value){
    $this->payload["value2"] = $value;
    return $this;
  }

  /**
   * Set value3 in the Payload of the Event
   *
   * @param String The Message Content
   * @return IFTTTWebhook Returns Instance of Self.
   */
  public function value3(string $value){
    $this->payload["value3"] = $value;
    return $this;
  }

}

?>
