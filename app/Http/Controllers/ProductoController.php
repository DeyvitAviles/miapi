<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    // LISTAR
    public function index()
    {
        return response()->json(
            Producto::latest()->get()
        );
    }

    // CREAR
    public function store(Request $request)
    {
        $imagen = null;

        // GUARDAR IMAGEN
        if ($request->hasFile('imagen')) {

            $archivo = $request->file('imagen');

            $nombreImagen = time() . '.'
                . $archivo->getClientOriginalExtension();

            $archivo->move(
                public_path('productos'),
                $nombreImagen
            );

            $imagen = 'productos/' . $nombreImagen;
        }

        $producto = Producto::create([

            'nombre' =>
                $request->nombre,

            'descripcion' =>
                $request->descripcion,

            'precio' =>
                $request->precio,

            'imagen' =>
                $imagen,

            'latitud' =>
                $request->latitud,

            'longitud' =>
                $request->longitud,
        ]);

        return response()->json([
            'message' => 'Producto creado',
            'producto' => $producto
        ]);
    }

    // MOSTRAR UNO
    public function show($id)
    {
        return response()->json(
            Producto::findOrFail($id)
        );
    }

    // EDITAR
    public function update(
        Request $request,
        $id
    ) {

        $producto =
            Producto::findOrFail($id);

        if ($request->hasFile('imagen')) {

            $archivo = $request->file('imagen');

            $nombreImagen = time() . '.'
                . $archivo->getClientOriginalExtension();

            $archivo->move(
                public_path('productos'),
                $nombreImagen
            );

            $producto->imagen =
                'productos/' . $nombreImagen;
        }

        $producto->nombre =
            $request->nombre;

        $producto->descripcion =
            $request->descripcion;

        $producto->precio =
            $request->precio;

        $producto->latitud =
            $request->latitud;

        $producto->longitud =
            $request->longitud;

        $producto->save();

        return response()->json([
            'message' => 'Producto actualizado'
        ]);
    }

    // ELIMINAR
    public function destroy($id)
    {
        Producto::destroy($id);

        return response()->json([
            'message' => 'Producto eliminado'
        ]);
    }
}