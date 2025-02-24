<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('immatriculation')->unique();
            $table->date('date_premiere_immatriculation');
            $table->foreignId('client_id')->constrained();
            $table->foreignId('marque_id')->constrained();
            $table->foreignId('modele_id')->constrained();
            $table->foreignId('detail_modele_id')->constrained();
            $table->string('version');
            $table->string('energie');
            $table->string('type_mines');
            $table->string('genre');
            $table->string('numero_chassis')->unique();
            $table->string('carrosserie')->nullable();
            $table->string('numero_moteur')->nullable();
            $table->date('date_prochaine_controle_technique')->nullable();
            $table->string('company_assurance')->nullable();
            $table->text('observations')->nullable();

            
            // JSON columns
            $table->json('autre_information');
            $table->json('controle_technique');
            $table->json('certificat_assurance');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
};