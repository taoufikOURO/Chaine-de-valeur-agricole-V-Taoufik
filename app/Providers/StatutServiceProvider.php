<?php

namespace App\Providers;

use App\Models\Statut;
use Illuminate\Support\ServiceProvider;

class StatutServiceProvider extends ServiceProvider
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
        $this->seedStatuts();
    }

    protected function seedStatuts()
    {
        $statuts = ["en_culture", "recoltee", "en_jachere"];
        foreach ($statuts as $statut) {
            Statut::firstOrCreate(['libelle' => $statut]);
        }
    }
}
