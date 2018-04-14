<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:30
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-25 14:01:04
 */
namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * This namespace is applied to your controller routes.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @return void
	 */
	public function boot()
	{
		//

		parent::boot();
	}

	/**
	 * Define the routes for the application.
	 *
	 * @return void
	 */
	public function map()
	{
		$this->mapApiRoutes();

		$this->mapWebRoutes();

		$this->mapAppsRoutes();
		$this->mapSiteRoutes();
		$this->mapAdminRoutes();
	}

	/**
	 * Define the "web" routes for the application.
	 *
	 * These routes all receive session state, CSRF protection, etc.
	 *
	 * @return void
	 */
	protected function mapWebRoutes()
	{
		Route::middleware('web')
			 ->namespace($this->namespace)
			 ->group(base_path('routes/web.php'));
	}

	/**
	 * Define the "api" routes for the application.
	 *
	 * These routes are typically stateless.
	 *
	 * @return void
	 */
	protected function mapApiRoutes()
	{
		Route::prefix('api')
			 ->middleware('api')
			 ->namespace($this->namespace)
			 ->group(base_path('routes/api.php'));
	}

	protected function mapAdminRoutes()
	{
		Route::middleware(['web', 'AppsMiddleware'])
			->namespace($this->namespace)
			->prefix('admin')
			->name('admin.')
			->group(base_path('routes/admin.php'));
	}

	protected function mapSiteRoutes()
	{
		Route::middleware(['web'])
			->namespace($this->namespace)
			->prefix('')
			->name('site.')
			->group(base_path('routes/site.php'));
	}

	protected function mapAppsRoutes()
	{
		Route::middleware(['web', 'AppsMiddleware'])
			->namespace($this->namespace)
			->prefix('apps')
			->name('apps.')
			->group(base_path('routes/apps.php'));
	}
}
