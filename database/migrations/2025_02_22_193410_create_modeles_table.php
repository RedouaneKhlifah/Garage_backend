<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('modeles', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('marque_id')->constrained()->onDelete('cascade'); // Foreign key to marques
            $table->string('name'); // Name of the model (e.g., LaFerrari, 911 GT3)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('modeles');
    }
};