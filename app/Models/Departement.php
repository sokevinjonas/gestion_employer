<?php

namespace App\Models;
use App\Models\Employer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departement extends Model
{
    use Hasfactory, HasUuids;
    protected $table = 'departements';
    protected $fillable = [
        'nom',
        'number_departement'
    ];

   
     
    // public function employers()
    // {
    //     return $this->hasMany(Employer::class);
    // }
}
