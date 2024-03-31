<?php

namespace App\Core;

use Dotenv\Dotenv;
use Sentry;

abstract class CoreApplication
{
	protected function initialize(): void
	{
		$this->initializeSentry();
		$this->initializeEnvironmentVars();
		$this->initializeConfig();
	}

	protected function initializeSentry(): void
	{
		Sentry\init([
			'dsn' => 'https://30dd3188d6104bb42606a189c04c702f@o104948.ingest.us.sentry.io/4507001085624320',
			'traces_sample_rate' => 1.0,
		]);
	}

	private function initializeEnvironmentVars(): void
	{
		if (!env('APP_NAME') && file_exists(ROOT . DS . '.env')) {
			$dotenv = Dotenv::createImmutable(ROOT . DS);
			$dotenv->load();
		}
	}

	abstract public static function startup();

	abstract protected function initializeConfig();

	abstract public function getApp();
}
