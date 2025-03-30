<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->seedUsers();
    }
    protected function seedUsers()
    {
        $users = [
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'phone_number' => '0123456789',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'role_id' => Role::where('libelle', 'admin')->first()->id ?? null,
                'password' => Hash::make('taoufik2005'), // Assure-toi d'utiliser un mot de passe sécurisé
            ],
            [
                'username' => 'agriculteur',
                'email' => 'agriculteur@gmail.com',
                'phone_number' => '0987654321',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'role_id' => Role::where('libelle', 'agriculteur')->first()->id ?? null,
                'password' => Hash::make('taoufik2005'),
            ]
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']], // Vérification basée sur l'email
                $userData
            );
        }
    }
}
