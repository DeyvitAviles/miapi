<?php

namespace App\Http\Controllers;

use App\Models\CarritoItem;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index(Request $request)
{
    return response()->json([
        'auth_user' => $request->user(),
        'all_items' => CarritoItem::all(),
    ]);
}

    public function agregar(Request $request)
    {
        $item = CarritoItem::updateOrCreate(

            [
                'user_id' => $request->user()->id,
                'producto_id' => $request->producto_id,
            ],

            [
                'cantidad' => $request->cantidad ?? 1,
            ]
        );

        return response()->json($item);
    }

    public function eliminar($id)
    {
        CarritoItem::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Eliminado'
        ]);
    }
}