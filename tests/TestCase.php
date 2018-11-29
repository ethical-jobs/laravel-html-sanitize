<?php

namespace Tests;

use EthicalJobs\Sanitize\ServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{	
	/**
	 * Inject package service provider
	 * 
	 * @param  Application $app
	 * @return array
	 */
	protected function getPackageProviders($app): array
	{
	    return [
	    	ServiceProvider::class,
	   	];
	}	
}
