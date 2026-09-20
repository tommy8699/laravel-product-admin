<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Electronics', 'Books', 'Home', 'Sport', 'Fashion'] as $name) Category::firstOrCreate(['name' => $name]);
        User::updateOrCreate(['email' => 'admin@test.com'], ['name' => 'Administrator', 'password' => Hash::make('password')]);
    }
}
