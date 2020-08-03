<?php

namespace nhalstead\Facilitator\Interfaces;


interface EventInterface
{

	/**
	 * Return the METHOD to send the Webhook Event as.
	 *
	 * @return string The METHOD
	 */
	public function get_method();

	/**
	 * Return the URL to the Webhook Event
	 *
	 * @return string The URL
	 */
	public function get_url();

	/**
	 * Return the Content Type of the Payload
	 *
	 * @return string The Content Type Header Format
	 */
	public function get_type();

	/**
	 * Get the Payload Stored in the Instance
	 *
	 * @return array|mixed Payload Data
	 */
	public function get_payload();

	/**
	 * Called to do the encoding for this package.
	 * Think of this as the Encoding or Serialize function.
	 * This allow for different formats of WebHook APIs, XML, JSON, Form-Data, etc.
	 *
	 * @return string The Data to Send in the Request.
	 */
	public function get_payload_request();

}


?>
