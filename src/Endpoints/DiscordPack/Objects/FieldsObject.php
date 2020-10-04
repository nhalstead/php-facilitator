<?php

namespace nhalstead\Facilitator\Endpoints\DiscordPack\Objects;

use nhalstead\Facilitator\Classes\Object;
use nhalstead\Facilitator\Interfaces\ObjectInterface;

/**
 * Discord Event
 *
 * @parent nhalstead\Request\Event
 * @link https://discordapp.com/developers/docs/resources/channel#embed-object
 */
class FieldsObject extends Object implements ObjectInterface
{

	protected $payloadBase = [

	];

	protected $element = [
		"name" => "",
		"value" => "",
		"inline" => false
	];

	public function add(array $in)
	{
		$t = array_merge($this->element, $in);
		$this->payload[] = $t;
		return $this;
	}

	/**
	 * Set Function, To Define The Params
	 *
	 * @param string The Value to Set
	 * @param mixed The Value
	 * @return FieldsObject
	 */
	public function set($key, $value)
	{
		$this->payload[$key] = $value;
		return $this;
	}

}

?>
