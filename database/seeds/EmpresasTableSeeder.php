<?php

use Illuminate\Database\Seeder;
use Products_JWT\Empresas;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $empresas = array(
            ['razon_social'=>'Ing. Gustavo Decker','nombre_comercial'=>'Deckasoft','direccion_matriz'=>'Alborada era etapa Mz CA v18','direccion_sucursal'=>'Alborada era etapa Mz CA v18','ruc_empresa'=>'0925490930001','telefono'=>'0988389345','user_id'=>'1']
        );

        foreach($empresas as $empresa){
            Empresas::create($empresa);
        }
    }
}
