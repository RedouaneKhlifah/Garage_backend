<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('car_technical_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->unique();
            $table->integer('puissance_fiscale');
            $table->integer('puissance_reelle_din');
            $table->integer('co2');
            $table->integer('cylindree');
            $table->integer('nombre_places');
            $table->integer('nombre_portes');
            $table->integer('dernier_kilometrage_releve');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('car_technical_infos');
    }
};