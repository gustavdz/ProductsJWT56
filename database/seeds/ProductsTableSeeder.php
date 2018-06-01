<?php

use Illuminate\Database\Seeder;
use Products_JWT\Products;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array(
            ['name'=>'Zapatos','detail'=>'Zapatos cafés','price'=>'79.99','user_id'=>1],
            ['name'=>'Camisa','detail'=>'Camisa blanca mangas largas','price'=>'25','user_id'=>1],
            ['name'=>'Reloj','detail'=>'Reloj cuero café','price'=>'90','user_id'=>1],
            ['name'=>'Celular','detail'=>'Iphone 7 plus','price'=>'800','user_id'=>2]
        );
        foreach($products as $product){
            Products::create($product);
        }
    }
}
