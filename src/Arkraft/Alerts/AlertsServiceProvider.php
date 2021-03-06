<?php namespace Arkraft\Alerts;

use Illuminate\Support\ServiceProvider;

class AlertsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot() {
		$this->addConfigComponent('arkraft/alerts', 'arkraft/alerts', realpath(__DIR__.'/../config'));
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return array("alerts");
	}

}
