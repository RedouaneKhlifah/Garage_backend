<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pneus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained();
            $table->enum('position', ['avant', 'arriere']);
            $table->enum('season', ['ete', 'hiver']);
            $table->integer('width');
            $table->integer('aspect_ratio');
            $table->integer('diameter');
            $table->string('indice_vitesse', 2);
            $table->integer('charge');
            $table->string('marque');
            $table->string('modele');
            $table->boolean('runflat')->default(false);
            $table->boolean('renforce')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pneus');
    }
};