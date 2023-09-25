<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Employer;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('reference');
            $table->string('montant');
            $table->dateTime('launch_date');
            $table->dateTime('done_date');
            $table->enum('status', ['SUCCESS', 'ECHEC'])->default('ECHEC');
            $table->enum('date_mois',[
                'JANVIER',
                'FEBRIER',
                'MARS',
                'AVRILE',
                'MAI',
                'JUIN',
                'JUILLET',
                'AOUT',
                'SEPTEMBRE',
                'OCTOBRE',
                'NOVEMBRE',
                'DECEMBRE'
            ]);
            $table->string('date_annee');
            
            $table->foreignIdFor(Employer::class, 'employer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
