<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    public function index(){
        $producto = Producto::all();
        return response()->json($producto, 200);
    }

    public function store(Request $request){
        $producto = Producto::create([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
        ]);

        return response()->json($producto, 200);
    }
}
