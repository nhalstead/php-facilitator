<?php

namespace nhalstead\Facilitator\Classes;

use nhalstead\Facilitator\Interfaces\ObjectInterface;

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
	 *
	 * @link https://stackoverflow.com/a/10072943/5779200
	 * @throws \ReflectionException
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
			if (!is_array($value)) {
				if (trim($value) === '' || $value === null) {
					unset($this->payload[$i]);
				}
			}
		}

		return $this->payload;
	}

}

?>
