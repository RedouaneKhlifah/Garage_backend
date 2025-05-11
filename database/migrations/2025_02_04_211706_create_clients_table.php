<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->enum('civility', ['Madame', 'Mademoiselle', 'Monsieur', 'Société', 'Aucune'])
                  ->comment('Civilité: required - Madame, Mademoiselle, Monsieur, Société, Aucune');
            $table->string('company')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();

            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();

            $table->string('email')->unique()->nullable();
            $table->string('website')->nullable();

            $table->string('main_phone')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('mobile')->nullable();

            $table->string('vat_number')->nullable()->comment('TVA Intra.');
            $table->text('observation')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('clients');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
