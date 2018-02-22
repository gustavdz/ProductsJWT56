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
            ['name'=>'Gustavo', 'email'=> 'gustavdz@gmail.com', 'password'=>bcrypt('Gustavo123'), 'admin'=>true]
        );
        foreach($users as $user){
            User::create($user);
        }
    }
}
