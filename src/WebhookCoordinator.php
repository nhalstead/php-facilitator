<?php
namespace nhalstead;

use nhalstad\Request\Event;
use nhalstead\Interfaces\EventImp;

/**
 * PHP Package to send Discord Webhook Events
 *
 * @link http://nhalstead.me
 */
class WebhookCoordinator {

  /**
   * The Queue that holds all of the events to send.
   *
   * @var array
   */
  private $queue = [];

  /**
   * The Debug Log, Used for Error Tracking in Requests.
   *
   * @var array
   */
  public $debugLog = [];

  /**
   * This is the path to the Root Cert pem file.
   * This will increace the security of the requests
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
  public function clearQueue(){
    $this->queue = [];
  }

  /**
  * Send a Single Event, Clalled Staticly
  *
  * @param nhalstead\Interfaces\EventImp The Webhook Event to Send.
  * @return nhalstaed\WebhookCoordinator
  */
  public static function sendStat(EventImp $e){
    $t = new self();
    $t->send($e);
    return $t;
  }

  /**
   * Send a Single Event.
   *
   * @param nhalstead\Interfaces\EventImp Event To Send
   */
  public function sendEvent(EventImp $e){
    $this->send($e);
  }

  /**
   * Send all the events in the queue.
   *
   * @param nhalstead\Interfaces\EventImp Event To Send Latter via the Queue
   */
  public function addEvent(EventImp $e){
    $this->queue = array_merge(array($e), $this->queue);
  }

  /**
   * Send the Pending Events in the Queue
   * Can only send a payload ONCE.
   *
   */
  public function sendEvents(){
    foreach($this->queue as $i => $event){

      if($event->sentOnce == true){
        // Skip is already Sent.
        $this->debugLog[] = "[   SKIP   ] ". $i;
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
   * @param nhalstead\Interfaces\EventImp The Webhook Event to Send
   * @return array Request Response Data
   */
  public function send(EventImp $e){

    $return = [
      "goodReqeust" => false,
      "url" => null
    ];

    // Set the URL
    $url = $e->get_url();
		$this->debugLog[] = "[ CURL:URL ] ".$url;
    $return['url'] = $url;
		$ch = curl_init($url);

    $payloadData = $e->get_payload_request(); // Set Here becuase it is used twice below, Reduce Serialize Time.

		// Check if the Root Pem file is defiend, Yes? Verify Connection
		if(isset($this->pem_cert) && @file_exists($this->pem_cert)){
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_CAINFO, $this->pem_cert);
		}
		else{
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		}

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadData );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "WebhookCoordinator/".self::VERSION);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: '.$e->get_type(),
			'Content-Length: ' . strlen($payloadData)
		));

		$result = curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if(curl_error($ch) != ""){
       // Log Error
       $this->debugLog[] = "[   ERROR  ] ". curl_error($ch);
    }

		if($result !== ""){
			if (preg_match('~Location: (.*)~i', $result, $match)) {
		   $location = trim($match[1]);
			 	$this->debugLog[]  = "[  REQUEST ] Redirected to another address.";
			}
		}

		if($http_code == 0){
			$this->debugLog[] = "[ REQUEST  ] Bad Request! (CURL Error)";
			$this->debugLog[] = "[  ^CURL   ]   ".curl_error($ch);
			$this->debugLog[] = "[  ^URL    ]   ".$url;
			$this->debugLog[] = "[  ^AGENT  ]   "."GitOdin-PHP/".self::VERSION;
			$this->debugLog[] = "[  ^PAYLOAD]   ".$content;
		}
		else if($http_code == 200 || $http_code == 201 || $http_code == 204){
			$this->debugLog[] = "[ REQUEST  ] Good Response from Server!";
			$this->debugLog[] = "[ REQUEST^ ] Request Time: ".curl_getinfo($ch, CURLINFO_TOTAL_TIME);
			$return['goodReqeust'] = true;
		}
		else if($http_code == 500){
			$this->debugLog[] = "[ REQUEST  ] AHHH! Server Problem! ".$http_code;
      $this->debugLog[] = "[ REQUEST^ ] Request Time: ".curl_getinfo($ch, CURLINFO_TOTAL_TIME);
			$this->debugLog[] = "[  ^URL    ]   ".$url;
			$this->debugLog[] = "[  ^PAYLOAD]   ".$payloadData;
		}
		else if($http_code == 404){
			$this->debugLog[] = "[ REQUEST  ] Hmm. I think you need to check the api URL! (Hint: Its Wrong!) ".$http_code;
      $this->debugLog[] = "[ REQUEST^ ] Request Time: ".curl_getinfo($ch, CURLINFO_TOTAL_TIME);
			$this->debugLog[] = "[  ^URL    ]   ".$url;
			$this->debugLog[] = "[  ^PAYLOAD]   ".$payloadData;
		}
		else if($http_code == 413){
			$this->debugLog[] = "[ REQUEST  ] Uhh, You have a Big Requst! Try to make it smaller! ".$http_code;
      $this->debugLog[] = "[ REQUEST^ ] Request Time: ".curl_getinfo($ch, CURLINFO_TOTAL_TIME);
			$this->debugLog[] = "[  ^URL    ]   ".$url;
			$this->debugLog[] = "[  ^PAYLOAD]   (Large Payload)";
		}
		else {
			$this->debugLog[] = "[ REQUEST  ] Bad Response from Server! ".$http_code;
      $this->debugLog[] = "[          ] ". str_replace("\r\n","",$result);
      $this->debugLog[] = "[ REQUEST^ ] Request Time: ".curl_getinfo($ch, CURLINFO_TOTAL_TIME);
			$this->debugLog[] = "[  ^URL    ]   ".$url;
			$this->debugLog[] = "[  ^PAYLOAD]   ".$payloadData;
		}

		curl_close($ch);
		return $return;
  }

}



?>
