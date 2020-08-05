<?php

namespace nhalstead\Facilitator\Request;

use nhalstead\Facilitator\Interfaces\ObjectInterface;
use ReflectionClass;

/**
 * Object
 *
 * This is the Same thing as the Event, BUT It is used to Inherit Attributes,
 *  This would be used for Attachments or Embeds
 */
class Object implements ObjectInterface
{

	/**
	 * Allows for Inline instantiation.
	 * Also Added in 5.4 of php cording to link
	 * @link https://stackoverflow.com/a/10072943/5779200
	 */
	public static function new()
	{
		$in = func_get_args();
		$reflect = new \ReflectionClass(get_called_class());
		return $reflect->newInstanceArgs($in);
	}

	/**
	 * Payload
	 *
	 * @var array
	 */
	protected $payload = array();

	/**
	 * Payload
	 *
	 * @var array
	 */
	protected $payloadBase = array();

	/**
	 * Create Instance and Pass in the URL to the Webhook
	 * This also Uses the $this->basicPayload to set the basic
	 *  layout of the payload on init.
	 *
	 * @param string URL of the Endpoint for the Webhook
	 */
	public function __construct()
	{
		// Set the Basic Layout of the Payload being Empty.
		$this->payload = $this->payloadBase;
	}

	/**
	 * Return the Object Data.
	 *
	 * @return array The Data to Return
	 */
	public function get_payload()
	{

		/**
		 * Clean up Values that are not set.
		 */
		foreach ($this->payload as $i => $value) {
			if (is_array($value) == false) {
				if (trim($value) === '' || $value === null) {
					unset($this->payload[$i]);
				}
			}
		}

		return $this->payload;
	}

}

?>
