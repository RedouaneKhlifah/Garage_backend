<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('detail_modeles', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('modele_id')->constrained()->onDelete('cascade'); // Foreign key to modeles
            $table->string('name'); // Name of the detail (e.g., 6.3L V12 Engine, Electric Powertrain)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_modeles');
    }
};