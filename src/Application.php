<?php
namespace App;

use App\Core\CoreApplication;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\JsonConfig;
use Cake\Core\Configure\Engine\PhpConfig;
use Exception;
use RuntimeException;
use Slim\Factory\AppFactory as SlimAppFactory;
use Slim\App as Slim;

class Application extends CoreApplication
{
	private Slim $app;

	public function __construct(Slim $app)
	{
		$this->initialize();

		$app = $this->registerRoutes($app);
		$app = $this->registerMiddleware($app);

		//$app->add(SessionMiddleware::class);
		$this->app = $app;
	}

	/**
	 * Startup Application
	 *
	 * @return Slim
	 * @throws RuntimeException
	 */
	public static function startup() : Slim
	{
		$app = SlimAppFactory::create();  // create a Slim App instance using the Factory
		return (new Application($app))->getApp();
	}

	/**
	 * Register routes
	 *
	 * Registers routes from config/routes.php
	 *
	 * @param Slim $app
	 * @return Slim
	 */
	private function registerRoutes(Slim $app): Slim
    {
		$routers = [];

		// load Management routes
		if (str_starts_with($_SERVER['HTTP_HOST'], 'pmt.fapho')) {
			if (!file_exists(ROUTES . 'pmt.php')) {
				throw new Exception('Management Routes not found.');
			}

			$routers[] = require_once ROUTES . 'pmt.php';
		}

		// load API routes
		if (str_starts_with($_SERVER['HTTP_HOST'], 'pmt.fapho') || str_starts_with($_SERVER['HTTP_HOST'], 'api.fapho')) {
			if (!file_exists(ROUTES . 'api.php')) {
				throw new Exception('API Routes not found.');
			}

			$routers[] = require_once ROUTES . 'api.php';
		}

		if ($routers && is_array($routers)){
			foreach($routers as $routes) {
				if (!is_callable($routes)) {
					throw new Exception('Routes not callable.');
				}
				$app = $routes($app);
			}
		} else {
			if (!file_exists(CONFIG . 'routes.php')) {
				throw new Exception('Routes not found.');
			}

			/** @var Closure $routes */
			$routes = require_once CONFIG . 'routes.php';
			$app = $routes($app);
		}

        return $app;
    }

	public function getApp() : Slim
	{
		return $this->app;
	}

	protected function initializeConfig() : void
	{
		try {
			Configure::config('default', new PhpConfig());
			Configure::load('app', 'default', false);

			//Configure::config('default', new JsonConfig(DATA));
		} catch (Exception $e) {
			exit($e->getMessage() . "\n");
		}
	}

	private function registerMiddleware(Slim $app): Slim
    {
        //$app->add(RoutesLoaderMiddleware::class);

        return $app;
    }
}
