<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        DB::table('users')->insert([
            'name' => 'Olayinka',
            'email' => 'olayinka.raheem16@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
