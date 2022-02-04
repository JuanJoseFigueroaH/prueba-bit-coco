<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ListaProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lista_productos')->insert([
            'producto_id' => 1,
            'user_id' => 1,
            'cantidad' => '5',
            'created_at' => Carbon::now()
        ]);

        DB::table('lista_productos')->insert([
            'producto_id' => 2,
            'user_id' => 2,
            'cantidad' => '10',
            'created_at' => Carbon::now()
        ]);
    }
}
