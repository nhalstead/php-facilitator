<?php

namespace nhalstead\Request;

use nhalstead\Interfaces\EventImp;

/**
 * Event
 *
 * This is the basic control for every payload. This gets used to Make the Request.
 * You can Extend this and add custom handles to it for more control but it does not
 *  matter overall as long as it all gets returned in the get_payload function.
 */
class Event implements EventImp {

  /**
   * Has been Sent Once
   *
   * @var boolean
   */
 public $sentOnce = false;

 /**
  * Content Type for Web Request
  *
  * @var string
  */
  protected $contentType = "application/json";

  /**
   * Event URL
   *
   * @var string
   */
  protected $eventURL = null;

  /**
   * Payload
   *
   * @var array
   */
  protected $payload = array();

  /**
   * Create Instance and Pass in the URL to the Webhook
   * This also Uses the $this->basicPayload to set the basic
   *  layout of the payload on init.
   *
   * @param string URL of the Endpoint for the Webhook
   */
  public function __construct(string $url = null, $basicPayload){
    $this->eventURL = $url;

    // Set the Basic Layout of the Payload being Empty.
    $this->payload = $basicPayload;
  }

  /**
   * Return the URL to the Webhook Event
   *
   * @return string The URL
   */
  public function get_url(){
   return $this->eventURL;
  }

  /**
   * Return the Content Type of the Payload
   *
   * @return string The Content Type Header Format
   */
  public function get_type(){
    return $this->contentType;
  }

  /**
   * Get the Payload Stored in the Instance
   *
   * @return Array Payload Data
   */
  public function get_payload(){
    return $this->payload;
  }

  /**
   * Called to do the encoding for this package.
   * Think of this as the Encoding or Serialize funciton.
   * This allow for different formats of WebHook APIs, XML, JSON, Form-Data, etc.
   *
   * @return string The Data to Send in the Request.
   */
  public function get_payload_request(){
/*
    // Clear Null or Empty Values.
    foreach ($this->payload as $key => $value) {
      if($value == null || empty($value)){
        unset($this->payload[$key]);
      }
    }*/

    return json_encode($this->payload);
  }

}




?>
