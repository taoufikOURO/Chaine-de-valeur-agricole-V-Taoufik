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
        Schema::create('fertilisation', function (Blueprint $table) {
            $table->id();
            $table->date('date_fertilisation')->default(Date::now());
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('parcelle_id')->constrained('parcelles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fertilisation');
    }
};
