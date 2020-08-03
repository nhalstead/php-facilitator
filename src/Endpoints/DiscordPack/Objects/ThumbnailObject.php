<?php

namespace nhalstead\Facilitator\Endpoints\DiscordPack\Objects;

use nhalstead\Facilitator\Request\Object;
use nhalstead\Facilitator\Interfaces\ObjectInterface;

/**
 * Discord Event
 *
 * @parent nhalstead\Request\Event
 * @link https://discordapp.com/developers/docs/resources/channel#embed-object
 */
class ThumbnailObject extends Object implements ObjectInterface
{

	protected $payloadBase = [
		"id" => "", // Type: Snowflake, attachment id
		"filename" => "", // name of file attached
		"size" => 0, // size of file in bytes
		"url" => "", // source url of file
		"proxy_url" => "", //	a proxied url of file
		"height" => 0,
		"width" => 0
	];

	/**
	 * Set Function, To Define The Params
	 *
	 * @param string The Value to Set
	 * @param mixed The Value
	 * @return ThumbnailObject
	 */
	function set($key, $value)
	{
		$this->payload[$key] = $value;
		return $this;
	}


}

?>
