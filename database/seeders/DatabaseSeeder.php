<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'admin',
            'email'     => 'admin@mail.com',
            'type'     => 'admin',
            'password'  => Hash::make('momomomo')
        ]);

        User::create([
            'name'      => 'client',
            'email'     => 'client@mail.com',
            'type'     => 'client',
            'password'  => Hash::make('momomomo')
        ]);
    }
}
