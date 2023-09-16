<?php

namespace App\Models;

use App\Models\Paiement;
use App\Models\Departement;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employer extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'employers';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'contact',
        'montant_journalier',
        'montant_journalier',
        'departement_id'
    ];
    
       
        public function departement(): BelongsTo
        {
            return $this->belongsTo(Departement::class);
        }
        public function payments(): HasMany
        {
            return $this->hasMany(Paiement::class);
        }
    
}
