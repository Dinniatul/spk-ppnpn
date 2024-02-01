<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        // Tambahkan data pengguna baru
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'role' => 'admin',
            'password' => Hash::make('password'), // Gantilah dengan password yang sesuai
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
