<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	[
        		'name'     => 'Manager',
        		'email'    => 'manager@test.com',
        		'password' => bcrypt('Manager'),
                'isAdmin'  => '1'
        	],
            [
                'name'     => 'Василий',
                'email'    => 'deemax3x3@mail.ru',
                'password' => bcrypt('Василий'),
                'isAdmin'  => '0'
            ]
        ];

        DB::table('users')->insert($data);
    }
}
