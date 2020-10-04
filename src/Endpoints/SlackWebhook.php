<?php

namespace nhalstead\Facilitator\Endpoints;

use nhalstead\Facilitator\Classes\Event;
use nhalstead\Facilitator\Interfaces\EventInterface;

/**
 * Slack Event
 *
 * @parent nhalstead\Request\Event
 * @link https://api.slack.com/incoming-webhooks#getting-started
 * @link https://api.slack.com/docs/slack-button#register_your_slack_app
 * @link https://api.slack.com/apps?new_app=1
 */
class SlackWebhook extends Event implements EventInterface
{

	public $payloadBase = [
		"text" => "", /** String Data */
		"attachments" => []/** Extra Data */
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
	 * Set the Message Content
	 *
	 * @param string $message The Message Content
	 * @return self Returns Instance of Self.
	 */
	public function message(string $message = null)
	{
		$this->payload['text'] = $message;
		return $this;
	}

	/**
	 * Add Attachment to the Payload
	 *
	 * @param EventInterface $e Event Payload
	 */
	public function addAttachment(EventInterface $e)
	{
		$this->payload['attachments'][] = $e->get_payload();
	}

}

?>
