<?php

namespace nhalstead\Facilitator;

use nhalstead\Facilitator\Exceptions\ServerErrorException;
use nhalstead\Facilitator\Exceptions\UnhandledException;
use nhalstead\Facilitator\Interfaces\EventInterface;
use nhalstead\Facilitator\Exceptions\UnauthorizedException;

/**
 * PHP Package to send Discord Webhook Events
 *
 * @link http://nhalstead.me
 */
class Facilitator
{

	/**
	 * The Queue that holds all of the events to send.
	 *
	 * @var array
	 */
	private $queue = [];

	/**
	 * This is the path to the Root Cert pem file.
	 * This will increase the security of the requests
	 *  although not required, it is recommended to use.
	 *
	 * @var string
	 */
	public $pem_cert;

	/**
	 * Used for the UA in the CURL Request
	 */
	const VERSION = 1.0;

	/**
	 * Delete all of the Queue, Clearing it of All Unset Events.
	 *  Gets Called by SendEvents after events are sent.
	 */
	public function clearQueue()
	{
		$this->queue = [];
	}

	/**
	 * Send a Single Event, Clalled Staticly
	 *
	 * @param EventInterface $e The Webhook Event to Send.
	 * @return Facilitator
	 * @throws UnauthorizedException
	 * @throws ServerErrorException
	 * @throws UnhandledException
	 */
	public static function sendStat(EventInterface $e)
	{
		$t = new self();
		$t->send($e);
		return $t;
	}

	/**
	 * Send a Single Event.
	 *
	 * @param EventInterface $e Event To Send
	 * @throws UnauthorizedException
	 * @throws ServerErrorException
	 * @throws UnhandledException
	 */
	public function sendEvent(EventInterface $e)
	{
		$this->send($e);
	}

	/**
	 * Send all the events in the queue.
	 *
	 * @param EventInterface $e Event To Send Latter via the Queue
	 */
	public function addEvent(EventInterface $e)
	{
		$this->queue = array_merge(array($e), $this->queue);
	}

	/**
	 * Send the Pending Events in the Queue
	 * Can only send a payload ONCE.
	 *
	 */
	public function sendEvents()
	{
		foreach ($this->queue as $i => $event) {

			if ($event->sentOnce == true) {
				// Skip is already Sent.
				continue;
			}

			$this->send($event);
			$event->sentOnce = true;
		}
		$this->clearQueue();
	}


	/**
	 * Send a Single Event Given the Event Instance.
	 *
	 * @param EventInterface $e The Webhook Event to Send
	 * @return bool
	 * @throws UnauthorizedException
	 * @throws ServerErrorException
	 * @throws UnhandledException
	 */
	public function send(EventInterface $e)
	{
		// Set the URL
		$url = $e->get_url();
		$ch = curl_init($url);

		$payloadData = $e->get_payload_request(); // Set Here becuase it is used twice below, Reduce Serialize Time.

		// Check if the Root Pem file is defined, Yes? Verify Connection
		if (isset($this->pem_cert) && @file_exists($this->pem_cert)) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_CAINFO, $this->pem_cert);
		} else {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		}

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($e->get_method()));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "WebhookCoordinator/" . self::VERSION);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: ' . $e->get_type(),
			'Content-Length: ' . strlen($payloadData)
		));

		$result = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if ($http_code === 200 || $http_code === 201) {
			return true;
		} else if ($http_code === 401 || $http_code === 403) {
			throw new UnauthorizedException($result);
		} else if ($http_code === 500) {
			throw new ServerErrorException($result);
		}

		throw new UnhandledException($result);
	}

}

?>
