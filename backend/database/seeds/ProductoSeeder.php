<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'codigo' => 'ACD001',
            'nombre' => 'Cuaderno',
            'created_at' => Carbon::now()
        ]);

        DB::table('productos')->insert([
            'codigo' => 'ADC001',
            'nombre' => 'Lapiz negro',
            'created_at' => Carbon::now()
        ]);
    }
}
