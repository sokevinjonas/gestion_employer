<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Departement;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Définir comme clé primaire
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->integer('contact')->unique();
            $table->integer('montant_journalier')->nullable();
            $table->foreignIdFor(Departement::class, 'departement_id');
            $table->timestamps();

            // Clé étrangère de Departement

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
