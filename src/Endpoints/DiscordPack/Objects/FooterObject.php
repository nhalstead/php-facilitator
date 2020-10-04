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
class FooterObject extends Object implements ObjectInterface
{

	protected $payloadBase = [
		"text" => "",
		"icon_url" => "",
		"proxy_icon_url" => ""
	];

	/**
	 * Set Function, To Define The Params
	 *
	 * @param string The Value to Set
	 * @param mixed The Value
	 * @return FooterObject
	 */
	function set($key, $value)
	{
		$this->payload[$key] = $value;
		return $this;
	}

}

?>
