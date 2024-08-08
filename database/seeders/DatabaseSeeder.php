<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(2)->create();

         \App\Models\User::factory()->create([
             'name' => 'Volodymyr',
             'email' => 'vs@gmail.com',
             'password' => 'qwerty123'
         ]);

        \App\Models\Todo::factory(10)->create();
    }
}
