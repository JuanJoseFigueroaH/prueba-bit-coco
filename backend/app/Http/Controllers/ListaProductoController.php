<?php

namespace App\Http\Controllers;

use App\ListaProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListaProductoController extends Controller
{
    public function index($user_id){
        $listaProducto = DB::table('lista_productos')
        ->join('productos', 'lista_productos.producto_id', '=', 'productos.id')
        ->where('lista_productos.user_id', $user_id)
        ->whereNull('lista_productos.deleted_at')
        ->select('lista_productos.id AS idList', 'lista_productos.cantidad', 'productos.id AS idPro', 'productos.codigo', 'productos.nombre')
        ->get();

        return response()->json($listaProducto, 200);
    }

    public function store(Request $request){
        $request->validate([
            'user'=>'required',
            'producto'=>'required',
            'cantidad'=>'required'
        ]);

        $listaProducto = ListaProducto::create([
            'producto_id' => $request->producto,
            'user_id' => $request->user,
            'cantidad' => $request->cantidad,
        ]);

        return response()->json($listaProducto, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user'=>'required',
            'producto'=>'required',
            'cantidad'=>'required'
        ]);

        $listaProducto = ListaProducto::find($id);
        $listaProducto->producto_id =  $request->get('producto');
        $listaProducto->user_id = $request->get('user');
        $listaProducto->cantidad = $request->get('cantidad');
        $listaProducto->save();

        return response()->json($listaProducto, 200);
    }

    public function destroy($id){
        $listaProducto = ListaProducto::find($id);
        $listaProducto->delete();

        return response()->json($listaProducto, 200);
    }
}
