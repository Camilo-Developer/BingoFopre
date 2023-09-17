<?php

namespace App\Http\Controllers\Api\CardBoards;

use App\Http\Controllers\Controller;
use App\Models\Cardboard\Cardboard;
use App\Models\CartonGroup\CartonGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
class CardBoardsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cardboards = Cardboard::all();
            return response()->json($cardboards, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }

    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $cardboard = Cardboard:: create($request->all());
            return response()->json(['message' => 'La carga masiva de cartones se hizo correctamente'], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public
    function show(string $id)
    {
        try {
            $cardboard = Cardboard:: find($id);
            return response()->json($cardboard, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }
    }


    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, string $id)
    {
        try {
            $cardboard = Cardboard:: find($id)->update($request->all());
            return response()->json(['message' => 'El cartón se ha editado correctamente'], 202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        try {
            $cardboard = Cardboard:: find($id)->delete();
            return response()->json(['message' => 'El cartón se a eliminado con éxito'], 202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }
    }

    public function create(Request $request)
    {
        try {
            $startNumber = strval($request->input('start_number')); // Convierte a cadena
            $endNumber = strval($request->input('end_number')); // Convierte a cadena
            $groupSize = $request->input('group_size');
            $date = $request->input('date');
            $price = $request->input('price');

            //$user_id = auth()->user()->id; // Obtener el ID del usuario autenticado

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
                    'state_id' => 3, // Reemplaza con el estado correcto
                    'group_id' => $group ? $group->id : null,
                ]);

                $groupCount++;
                // Asigna el group_id al cartón
                $cardboard->group_id = $group ? $group->id : null;
                $cardboard->save();
            }
            return response()->json(['message' => 'Los cartones se crearón correctamente'], 202);

        } catch (ValidationException $e) {
            // Manejo de excepciones de validación
            return response()->json(['error' => 'Error de validación'], 400);
        } catch (QueryException $e) {
            // Manejo de excepciones de consulta de base de datos
            return response()->json(['error' => 'Error de base de datos'], 500);
        } catch (Exception $e) {
            // Manejo de otras excepciones no previstas
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function addToCart($name)
    {
        try {
            // Buscar el cartón por el nombre en lugar del ID
            $carton = Cardboard::where('name', $name)->first();

            // Verificar si se encontró el cartón
            if (!$carton) {
                return response()->json(['error' => 'Ocurrió un error inesperado'], 500);
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
            return response()->json(['message' => 'El cartón se ha añadido al carrito'], 202);

        } catch (Exception $e) {
            // Manejo de excepciones
            return response()->json(['error' => 'Ocurrió un error inesperado'], 500);
        }
    }

    public function finishPurchase(Request $request)
    {
        try {
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

            return response()->json(['message' => 'El cartón se ha vendido correctamente'], 202);
        } catch (ValidationException $e) {
            // Manejo de excepciones de validación
            return response()->json(['error' => 'Error de validación'], 400);
        } catch (QueryException $e) {
            // Manejo de excepciones de consulta de base de datos
            return response()->json(['error' => 'Error de base de datos'], 500);
        } catch (Exception $e) {
            // Manejo de otras excepciones no previstas
            return response()->json(['error' => 'Ocurrió un error inesperado'], 500);
        }
    }

    public function removeFromCart($cartonId)
    {
        try {
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

            return response()->json(['message' => 'Cartón eliminado del carrito con éxito'], 202);


        } catch (Exception $e) {
            // Manejo de excepciones
            return response()->json(['error' => 'Ocurrió un error inesperado.'], 400);

        }
    }

}
