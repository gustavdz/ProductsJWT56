<?php

use Illuminate\Database\Seeder;
use Products_JWT\Clients;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = array(
            ['name'=>'Edison','last_name'=>'Cordero','email'=>'andrescorderop@gmail.com','dni'=>'0920783701','client_vip'=>false,'phone'=>'0991155849','address'=>'alborada 6ta etapa','user_id'=>'1']
        );

        foreach($clients as $client){
            Clients::create($client);
        }
    }
}
