<?php

namespace nhalstead\Facilitator\Endpoints;

use nhalstead\Facilitator\Classes\Event;
use nhalstead\Facilitator\Interfaces\EventInterface;
use nhalstead\Facilitator\Interfaces\ObjectInterface;

/**
 * Discord Event
 *
 * @parent nhalstead\Request\Event
 * @link https://discordapp.com/developers/docs/resources/webhook#execute-webhook
 */
class DiscordWebhook extends Event implements EventInterface
{

	public $payloadBase = [
		"username" => null, // Override the Username for the Message
		"avatar_url" => null, // Override Avatar URL for the Message
		"content" => "", // String Data
		"tts" => false, // Text To Speech
		"file" => null, // File Uploads
		"embeds" => array() // Embed Object
	];

	/**
	 * Call Parent with the Basic Payload Layout.
	 *
	 * @param string $url
	 */
	public function __construct(string $url)
	{
		parent::__construct($url, $this->payloadBase);
	}

	/**
	 * Toggle the Value for the Text to Speech
	 *
	 * @return DiscordWebhook Returns Instance of Self.
	 */
	public function tts_toggle()
	{
		$this->payload['tts'] = !$this->payload['tts'];
		return $this;
	}

	/**
	 * set the Name to use in the Message
	 *
	 * @param String The Name to Use when Adding the Message
	 * @return DiscordWebhook Returns Instance of Self.
	 */
	public function username(string $name = null)
	{
		$this->payload['username'] = $name;
		return $this;
	}

	/**
	 * Set the Message Content
	 *
	 * @param String The Message Content
	 * @return DiscordWebhook Returns Instance of Self.
	 */
	public function message(string $message = null)
	{
		$this->payload['content'] = $message;
		return $this;
	}

	/**
	 * Set the Icon Content
	 *
	 * @param String URL to the Image to Use for the Profile Picture.
	 * @return DiscordWebhook Returns Instance of Self.
	 */
	public function avatar(string $url = null)
	{
		$this->payload['avatar_url'] = $url;
		return $this;
	}

	/**
	 * Add Attachment to the Payload
	 *
	 * @param ObjectInterface $e Event Payload
	 * @return DiscordWebhook
	 */
	public function addEmbed(ObjectInterface $e)
	{
		$this->payload['embeds'][] = $e->get_payload();
		return $this;
	}

}

?>
