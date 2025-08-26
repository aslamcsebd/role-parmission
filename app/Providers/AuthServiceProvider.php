<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	protected $policies = [];

	public function boot(): void
	{
		$this->registerPolicies();

		try {
			Permission::all()->each(function ($permission) {
				Gate::define($permission->name, function ($user) use ($permission) {
					return $user->hasPermission($permission->name);
				});
			});
		} catch (\Exception $e) {
			// handle error in migration/seeding context
		}
	}
}