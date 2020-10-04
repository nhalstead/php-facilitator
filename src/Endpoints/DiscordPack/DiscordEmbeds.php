<?php

namespace nhalstead\Facilitator\Endpoints\DiscordPack;

use nhalstead\Facilitator\Classes\Object;
use nhalstead\Facilitator\Interfaces\ObjectInterface;

/**
 * Discord Event
 *
 * @parent nhalstead\Request\Event
 * @link https://discordapp.com/developers/docs/resources/channel#embed-object
 */
class DiscordEmbeds extends Object implements ObjectInterface
{

	public $payloadBase = [
		'title' => '', // [256]
		'type' => '', // type of embed (always "rich" for webhook embeds) [2048]
		'description' => '', // description of embed
		'url' => '',
		'timestamp' => "", // Type: ISO8601 timestamp, timestamp of embed content, date('c')
		/*'color' => 0,*/

		// objects, Single Element
		'footer' => null,
		'image' => null,
		'thumbnail' => null,
		'video' => null,
		'provider' => null,
		'author' => null,
		'fields' => array() // [25]
	];

	private $objects = [
		'footer' => [
			"text" => "",
			"icon_url" => "",
			"proxy_icon_url" => ""
		],
		'image' => [
			"url" => "",
			"proxy_url" => "",
			"height" => 0,
			"width" => 0
		],
		'thumbnail' => [
			"id" => "", // Type: Snowflake, attachment id
			"filename" => "", // name of file attached
			"size" => 0, // size of file in bytes
			"url" => "", // source url of file
			"proxy_url" => "", // a proxied url of file
			"height" => 0,
			"width" => 0
		],
		'video' => [
			"url" => "",
			"height" => 0,
			"width" => 0
		],
		'provider' => [
			"name" => "",
			"url" => ""
		],
		'author' => [
			"name" => "",
			"url" => "",
			"icon_url" => "",
			"proxy_icon_url" => ""
		],
		'fields' => [
			"name" => "",
			"value" => "",
			"inline" => false
		],
	];

	/**
	 * Set Function, To Define The Params
	 *
	 * @param String The Value to Set
	 * @param Mixed The Value
	 * @return DiscordEmbeds
	 */
	function set($key, $value)
	{
		$this->payload[$key] = $value;
		return $this;
	}

	/**
	 * Add Attachment to the Payload
	 *
	 * @param $name
	 * @param ObjectInterface $e Event Payload
	 * @return DiscordEmbeds
	 */
	public function addEmbed($name, ObjectInterface $e)
	{
		$this->payload[$name] = $e->get_payload();
		return $this;
	}


}

?>
