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
        \DB:: table('users')->insert(array(
            'name' =>'Administrador',
            'email'=>'admin1@gmail.com',
            'password'=>\Hash::make('admin1'),
            'type'=>'adminsist',
        	));
    }
}
