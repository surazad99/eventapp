<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('TRUNCATE users;');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $user = [
            'name' => 'John Doe',
            'email' => 'user@gmail.com',
            'password' => bcrypt('User@12345')
        ];

        DB::table('users')->insert($user);
    }
}
