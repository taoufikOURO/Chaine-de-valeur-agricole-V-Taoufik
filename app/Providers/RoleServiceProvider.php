<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->seedRoles();
    }
    protected function seedRoles()
    {
        $roles = ["admin", "agriculteur"];
        foreach ($roles as $role) {
            Role::firstOrCreate(['libelle' => $role]);
        }
    }
}
