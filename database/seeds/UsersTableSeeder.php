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
            ['name'=>'Gustavo', 'username'=>'gustavdz','email'=> 'gustavdz@gmail.com', 'password'=>bcrypt('Gustavo123'), 'admin'=>true],
            ['name'=>'Nayibe', 'username'=>'nsanchez','email'=> 'princesita_superhappy_4you@hotmail.com', 'password'=>bcrypt('123123'), 'admin'=>false]
        );
        foreach($users as $user){
            User::create($user);
        }
    }
}
