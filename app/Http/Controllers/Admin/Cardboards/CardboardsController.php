<?php

namespace App\Http\Controllers\Admin\Cardboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cardboard\Cardboard;
use App\Models\CartonGroup\CartonGroup;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Session;


class CardboardsController extends Controller
{
    public function createForm()
    {
        $cartones = Cardboard::all();
        return view('admin.cartones.create',compact('cartones'));
    }


    public function create(Request $request)
    {
        $startNumber = strval($request->input('start_number')); // Convierte a cadena
        $endNumber = strval($request->input('end_number')); // Convierte a cadena
        $groupSize = $request->input('group_size');
        $date = $request->input('date');
        $price = $request->input('price');

        $user_id = auth()->user()->id; // Obtener el ID del usuario autenticado

        $group = null;
        $groupCount = 0;

        for ($i = $startNumber; $i <= $endNumber; $i++) {
            if ($groupCount % $groupSize === 0) {
                $group = CartonGroup::create(['user_id' => null]);
            }

            // Formatea el nombre del cartón con ceros a la izquierda
            $formattedName = str_pad($i, strlen($endNumber), '0', STR_PAD_LEFT);

            $cardboard = Cardboard::create([
                'name' => $formattedName,
                'date_finish' => $date,
                'price' => $price,
                'state_id' => 1, // Reemplaza con el estado correcto
                'group_id' => $group ? $group->id : null,
                'user_id' => null,
            ]);

            $groupCount++;
            // Asigna el group_id al cartón
            $cardboard->group_id = $group ? $group->id : null;
            $cardboard->save();
        }

        return redirect()->route('admin.cartones.createForm')->with('success', 'Cartones y grupos creados exitosamente.');
    }

    public function addToCart($name) {
        // Buscar el cartón por el nombre en lugar del ID
        $carton = Cardboard::where('name', $name)->first();

        // Verificar si se encontró el cartón
        if (!$carton) {
            return redirect()->route('dashboard')->with('error', 'El cartón no fue encontrado.');
        }

        $cart = session()->get('cart');

        $cart[$carton->id] = [
            'name' => $carton->name,
            'quantity' => 1,
            'date_finish' => $carton->date_finish,
            'price' => $carton->price,
            'state_id' => $carton->state_id,
            'user_id' => $carton->user_id,
            'document_number' => $carton->document_number,
        ];

        session()->put('cart', $cart);
        return redirect()->route('dashboard')->with('success', 'Se añadió al carrito con éxito.');
    }
    public function showCart()
    {
        // Obtener el carrito desde la sesión
        $cart = Session::get('cart', []);

        return view('user.cart.index', compact('cart'));
    }


    public function finishPurchase(Request $request)
    {
        // Obtener el carrito desde la sesión
        $cart = Session::get('cart', []);

        // Obtener datos de estado y usuario de cada cartón desde el formulario
        $cartonData = $request->input('cartons');
        $documentoComprador = $request->input('document_number');

        // Iterar a través de los elementos del carrito y actualizar la base de datos
        foreach ($cart as $cartonId => $carton) {
            // Verificar si el cartón existe en la base de datos
            $cartonDB = Cardboard::find($cartonId);

            if ($cartonDB) {
                // Actualiza el estado y el campo user_id del cartón en la base de datos
                $cartonDB->state_id = $cartonData[$cartonId]['state_id'];
                $cartonDB->document_number = $documentoComprador;
                $cartonDB->save();
            }
        }

        // Limpia el carrito en la sesión
        Session::forget('cart');

        return redirect()->route('user.cart.index')->with('success', 'Compra finalizada con éxito.');
    }



    public function removeFromCart($cartonId)
    {
        // Obtener el carrito desde la sesión
        $cart = Session::get('cart', []);

        // Verificar si el cartón existe en el carrito
        if (isset($cart[$cartonId])) {
            // Elimina el cartón del carrito
            unset($cart[$cartonId]);

            // Actualiza el carrito en la sesión
            Session::put('cart', $cart);

            return redirect()->route('user.cart.index')->with('success', 'Cartón eliminado del carrito con éxito.');
        }

        return redirect()->route('user.cart.index')->with('error', 'El cartón no se encontró en el carrito.');
    }





}
