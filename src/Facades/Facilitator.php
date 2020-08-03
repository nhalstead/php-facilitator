<?php

namespace nhalstead\Facilitator\Facades;

use Illuminate\Support\Facades\Facade;

class Facilitator extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'facilitator';
	}
}