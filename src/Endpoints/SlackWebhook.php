<?php

namespace nhalstead\Endpoints;

use nhalstead\Request\Event;
use nhalstead\Interfaces\EventImp;

/**
 * Slack Event
 *
 * @parent nhalstead\Request\Event
 * @link https://api.slack.com/incoming-webhooks#getting-started
 * @link https://api.slack.com/docs/slack-button#register_your_slack_app
 * @link https://api.slack.com/apps?new_app=1
 */
class SlackWebhook extends Event implements EventImp {

  public $payloadBase = [
    "text" => "", /** String Data */
    "attachments" => [] /** Extra Data */
  ];

  /**
   * Call Parent with the Basic Payload Layout.
   */
  public function __construct(string $url){
    parent::__construct($url, $this->payloadBase);
  }

  /**
   * Set the Message Content
   *
   * @param String The Message Content
   * @return Discord Returns Instance of Self.
   */
  public function message(string $message = null){
    $this->payload['text'] = $message;
    return $this;
  }

  /**
   * Add Attachment to the Payload
   *
   * @param nhalstead\Interfaces\EventImp Event Payload
   */
  public function addAttachment(EventImp $e){
    $this->payload['attachments'][] = $e->get_payload();
  }

}

?>
