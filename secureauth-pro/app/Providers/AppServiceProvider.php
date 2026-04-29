<?php

namespace App\Providers;

use App\Models\SecureNote;
use App\Policies\SecureNotePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // The policy binds every SecureNote action to the authenticated owner,
        // so users cannot read or change another user's private notes by URL.
        Gate::policy(SecureNote::class, SecureNotePolicy::class);
    }
}
