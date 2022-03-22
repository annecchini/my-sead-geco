<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoleSeeder extends Seeder
{
    protected $tableName = 'poles';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table($this->tableName)->insert(['name' => 'Vitória', 'description' => 'Polo de Vitória', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Afonso Cláudio', 'description' => 'Polo de Afonso Cláudio', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Alegre', 'description' => 'Polo de Alegre', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Aracruz', 'description' => 'Polo de Aracruz', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Baixo Guandu', 'description' => 'Polo de Baixo Guandu', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Bom Jesus do Norte', 'description' => 'Polo de Bom Jesus do Norte', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Cachoeiro de Itapemirim', 'description' => 'Polo de Cachoeiro de Itapemirim', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Castelo', 'description' => 'Polo de Castelo', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Colatina', 'description' => 'Polo de Colatina', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Conceição da Barra', 'description' => 'Polo de Conceição da Barra', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Domingos Martins', 'description' => 'Polo de Domingos Martins', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Ecoporanga', 'description' => 'Polo de Ecoporanga', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Itapemirim', 'description' => 'Polo de Itapemirim', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Iúna', 'description' => 'Polo de Iúna', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Linhares', 'description' => 'Polo de Linhares', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Mantenópolis', 'description' => 'Polo de Mantenópolis', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Mimoso do Sul', 'description' => 'Polo de Mimoso do Sul', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Montanha', 'description' => 'Polo de Montanha', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Nova Venécia', 'description' => 'Polo de Nova Venécia', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Pinheiros', 'description' => 'Polo de Pinheiros', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Piúma', 'description' => 'Polo de Piúma', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Santa Leopoldina', 'description' => 'Polo de Santa Leopoldina', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Santa Teresa', 'description' => 'Polo de Santa Teresa', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'São Mateus', 'description' => 'Polo de São Mateus', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Vargem Alta', 'description' => 'Polo de Vargem Alta', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Venda Nova do Imigrante', 'description' => 'Polo de Venda Nova do Imigrante', 'created_at' => now(), 'updated_at' => now()]);
        DB::table($this->tableName)->insert(['name' => 'Vila Velha', 'description' => 'Polo de Vila Velha', 'created_at' => now(), 'updated_at' => now()]);
    }
}
