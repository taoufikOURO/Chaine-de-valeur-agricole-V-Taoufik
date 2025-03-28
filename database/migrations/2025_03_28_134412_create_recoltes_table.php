<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recoltes', function (Blueprint $table) {
            $table->id();
            $table->date('date_recolte')->default(Date::now());
            $table->float('quantite_recolte')->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('semis_id')->constrained('semis')->onDelete('cascade');
            $table->foreignId('parcelle_id')->constrained('parcelles')->onDelete('cascade');
            $table->foreignId('semis_id')->nullable()->constrained('semis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recoltes');
    }
};
