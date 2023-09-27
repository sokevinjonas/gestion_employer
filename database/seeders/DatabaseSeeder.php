<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'id' => Str::uuid(),
            'nom' => 'SO',
            'prenom' => 'Jonas',
            'email' => 'test@gmail.com',
            'password' => Hash::make('1234'),
        ]);
    }
}
