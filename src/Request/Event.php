<?php

namespace nhalstead\Facilitator\Request;

use nhalstead\Facilitator\Interfaces\EventInterface;
use ReflectionClass;

/**
 * Event
 *
 * This is the basic control for every payload. This gets used to Make the Request.
 * You can Extend this and add custom handles to it for more control but it does not
 *  matter overall as long as it all gets returned in the get_payload function.
 */
class Event implements EventInterface
{

	/**
	 * Allows for Inline instantiation.
	 *
	 * @link https://stackoverflow.com/a/10072943/5779200
	 */
	public static function new()
	{
		$in = func_get_args();
		$reflect = new ReflectionClass(get_called_class());
		return $reflect->newInstanceArgs($in);
	}

	/**
	 * Has been Sent Once
	 *
	 * @var boolean
	 */
	public $sentOnce = false;

	/**
	 * Content Type for Web Request
	 * Data type of the content when it uses the output of `get_payload_request`
	 *  make sure if you change it to be XML that the output of `get_payload_request`
	 *  is also setup for XML, otherwise the request should fail with 400.
	 *
	 * @var string
	 */
	protected $contentType = "application/json";

	/**
	 * Event URL
	 * The URL to contact to send the data to.
	 *
	 * @var string
	 */
	protected $eventMethod = "POST";

	/**
	 * Event URL
	 * The URL to contact to send the data to.
	 *
	 * @var string
	 */
	protected $eventURL = null;

	/**
	 * Payload
	 * Data to send in the Request, This tends to an array full of data.
	 * You can override this default type from an Array to anything as this
	 *  does not have a defined data type. Just be mindfull that the method
	 *  `get_payload_request` is supposed to return a string and by default
	 *  is `json_encode` (expects an array input).
	 *
	 * @var array
	 */
	protected $payload = array();

	/**
	 * Create Instance and Pass in the URL to the Webhook
	 * This also Uses the $this->basicPayload to set the basic
	 *  layout of the payload on init.
	 *
	 * @param string|null $url
	 * @param array $basicPayload
	 */
	public function __construct(string $url = null, $basicPayload = array())
	{
		$this->eventURL = $url;

		// Set the Basic Layout of the Payload being Empty.
		$this->payload = $basicPayload;
	}

	/**
	 * Return the METHOD to send the Webhook Event as.
	 *
	 * @return string The METHOD
	 */
	public function get_method()
	{
		return $this->eventMethod;
	}

	/**
	 * Return the URL to the Webhook Event
	 *
	 * @return string The URL
	 */
	public function get_url()
	{
		return $this->eventURL;
	}

	/**
	 * Return the Content Type of the Payload
	 *
	 * @return string The Content Type Header Format
	 */
	public function get_type()
	{
		return $this->contentType;
	}

	/**
	 * Get the Payload Stored in the Instance
	 *
	 * @return Array|Mixed Payload Data
	 */
	public function get_payload()
	{
		return $this->payload;
	}

	/**
	 * Called to do the encoding for this package.
	 * Think of this as the Encoding or Serialize funciton.
	 * This allow for different formats of WebHook APIs, XML, JSON, Form-Data, etc.
	 *
	 * @return string The Data to Send in the Request.
	 */
	public function get_payload_request()
	{

		return json_encode($this->payload);
	}

}


?>
