<?php

namespace nhalstead\Facilitator\Endpoints\SlackPack;

use nhalstead\Facilitator\Classes\Event;
use nhalstead\Facilitator\Interfaces\EventInterface;

/**
 * Slack Event
 *
 * @link https://api.slack.com/incoming-webhooks#posting_with_webhooks
 */
class SlackAttachments extends Event implements EventInterface
{

	public $payloadBase = [
		'title' => '',
		'text' => '',
		'author_name' => '',
		'author_icon' => '',
		'fields' => '',
		'image_url' => '',
	];

	/**
	 * Call Parent with the Basic Payload Layout.
	 */
	public function __construct()
	{
		parent::__construct(null, $this->payloadBase);
	}

	/**
	 * Set the Title of the Attachment
	 *
	 * @param String The Title
	 * @return SlackAttachments Returns Instance of Self.
	 */
	public function title(string $message = null)
	{
		$this->payload['title'] = $message;
		return $this;
	}

	/**
	 * Set the Message Content
	 *
	 * @param String The Message Content
	 * @return SlackAttachments Returns Instance of Self.
	 */
	public function message(string $message = null)
	{
		$this->payload['text'] = $message;
		return $this;
	}

	/**
	 * Set the Author Name
	 *
	 * @param String Author Name
	 * @return SlackAttachments Returns Instance of Self.
	 */
	public function author_name(string $message = null)
	{
		$this->payload['author_name'] = $message;
		return $this;
	}

	/**
	 * Set the Author Icon
	 *
	 * @param String Author Icon
	 * @return SlackAttachments Returns Instance of Self.
	 */
	public function author_icon(string $message = null)
	{
		$this->payload['author_icon'] = $message;
		return $this;
	}

	/**
	 * Set Extra Fields
	 *
	 * @param string $message Fields
	 * @return SlackAttachments Returns Instance of Self.
	 */
	private function fields(string $message = null)
	{
		$this->payload['fields'] = $message;
		return $this;
	}

	/**
	 * Set the image URL for the Event
	 *
	 * @param String The Image
	 * @return SlackAttachments Returns Instance of Self.
	 */
	public function image_url(string $message = null)
	{
		$this->payload['image_url'] = $message;
		return $this;
	}

}


?>
