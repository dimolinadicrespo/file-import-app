<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zones')->truncate();
        DB::table('users')->truncate();
         User::factory(1)->create([
             'name' => 'admin',
             'email' => 'admin@admin.es',
             'password' => Hash::make('12345678'),
             'remember_token' => Str::random(10),
         ]);
    }
}
