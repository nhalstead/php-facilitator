<?php

namespace nhalstead\Facilitator\Interfaces;

/**
 * This is the bearmin to use the WebhookCoordinator Request System.
 * You can make your own Event Class that does a different process
 *  than what I am doing. I am leaving it open for dev.
 *
 * This currently does not do DataType for the Request but the Comments have them specified.
 */
interface ObjectInterface
{

	/**
	 * Return the Object Data.
	 *
	 * @return array The Data to Return
	 */
	public function get_payload();

}


?>
