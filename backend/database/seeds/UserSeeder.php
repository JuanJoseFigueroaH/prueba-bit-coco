<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nombre' => 'Juan Figueroa',
            'email' => 'administrador@gmail.com',
            'password' => Hash::make('12345'),
            'rol' => 'Administrador',
            'created_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'nombre' => 'Carlos Sanchez',
            'email' => 'carlosanchez@gmail.com',
            'password' => Hash::make('12345'),
            'rol' => 'Usuario',
            'created_at' => Carbon::now()
        ]);
    }
}
