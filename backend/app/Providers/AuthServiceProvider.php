<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Money;
use App\Policies\MoneyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The model to policy mappings for the application.
	 *
	 * @var array<class-string, class-string>
	 */
	protected $policies = [
		Money::class => MoneyPolicy::class
	];

	/**
	 * Register any authentication / authorization services.
	 */
	public function boot(): void
	{
		//
	}
}
