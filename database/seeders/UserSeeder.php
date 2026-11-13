<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $lola = User::create([
            'name' => 'Lola Casia',
            'email' => 'lola.casia@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        $kagawad = User::create([
            'name' => 'Julianne Marie Casia',
            'email' => 'kagawad.casia@bulletin.test',
            'password' => Hash::make('bulletin2026'),
        ]);

        Author::where('email', 'kagawad.casia@bulletin.test')->update(['user_id' => $kagawad->id]);
        User::factory()->count(8)->create();
    }
}
