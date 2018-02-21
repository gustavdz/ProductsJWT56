<?php

use Illuminate\Database\Seeder;
use Products_JWT\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            ['name'=>'Andres', 'email'=> 'andres@hotmail.com', 'password'=>Hash::make('123456')]
        );
        foreach($users as $user){
            User::create($user);
        }
    }
}
