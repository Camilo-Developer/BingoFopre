<?php

namespace App\Http\Controllers\Admin\Cardboards;

use App\Http\Controllers\Controller;
use App\Models\State\State;
use Illuminate\Http\Request;

use App\Models\Cardboard\Cardboard;
use App\Models\CartonGroup\CartonGroup;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

class CardboardsController extends Controller
{
    public function createForm(Request $request)
    {
        $search = $request->input('search');
        $cardboards = Cardboard::query()
            ->where('name', 'LIKE', "%$search%")
            ->orderBy('id', 'desc')
            ->paginate(10);
        $states = State::all();
        $carton_groups = CartonGroup::all();
        return view('admin.cartones.create',compact(
            'cardboards',
            'search',
            'states',
            'carton_groups',
        ));
    }
    public function create(Request $request)
    {
        $startNumber = strval($request->input('start_number'));
        $endNumber = strval($request->input('end_number'));
        $groupSize = $request->input('group_size');
        $price = $request->input('price');
        $group = null;
        $groupCount = 0;
        for ($i = $startNumber; $i <= $endNumber; $i++) {
            if ($groupCount % $groupSize === 0) {
                $group = CartonGroup::create(['user_id' => null]);
            }
            $formattedName = str_pad($i, strlen($endNumber), '0', STR_PAD_LEFT);
            $cardboard = Cardboard::create([
                'name' => $formattedName,
                'price' => $price,
                'state_id' => 3,
                'group_id' => $group ? $group->id : null,
            ]);
            $groupCount++;
            $cardboard->group_id = $group ? $group->id : null;
            $cardboard->save();
        }
        return redirect()->route('admin.cartones.createForm')->with('success', 'Cartones y grupos creados exitosamente.');
    }

    public function addToCart($name) {
        if (Auth::check()) {
            $carton = Cardboard::where('name', $name)->first();
            if (!$carton) {
                return redirect()->route('dashboard')->with('error', 'El cartón no fue encontrado.');
            }
            if ($carton->state_id == 3) {
                $user = Auth::user();
                $grupoIdsDelUsuario = $user->cartongroup->pluck('id')->toArray();
                if (in_array($carton->group_id, $grupoIdsDelUsuario)) {
                    $cart = session()->get('cart');
                    $cart[$carton->id] = [
                        'name' => $carton->name,
                        'quantity' => 1,
                        'price' => $carton->price,
                        'state_id' => $carton->state_id,
                        'user_id' => $carton->user_id,
                        'document_number' => $carton->document_number,
                    ];
                    session()->put('cart', $cart);
                    return redirect()->route('dashboard')->with('success', 'Se añadió al carrito con éxito.');
                } else {
                    return redirect()->route('dashboard')->with('error', 'No tienes permiso para agregar este cartón al carrito.');
                }
            } else {
                return redirect()->route('dashboard')->with('error', 'Este cartón no puede ser agregado al carrito porque su estado no es 3.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar cartones al carrito.');
        }
    }

    public function showCart()
    {
        $cart = Session::get('cart', []);
        return view('user.cart.index', compact('cart'));
    }
    public function finishPurchase(Request $request)
    {
        $cart = Session::get('cart', []);
        $cartonData = $request->input('cartons');
        $documentoComprador = $request->input('document_number');
        foreach ($cart as $cartonId => $carton) {
            $cartonDB = Cardboard::find($cartonId);
            if ($cartonDB) {
                $cartonDB->state_id = $cartonData[$cartonId]['state_id'];
                $cartonDB->document_number = $documentoComprador;
                $cartonDB->save();
            }
        }
        Session::forget('cart');
        return redirect()->route('user.cart.index')->with('success', 'Compra finalizada con éxito.');
    }
    public function removeFromCart($cartonId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$cartonId])) {
            unset($cart[$cartonId]);
            Session::put('cart', $cart);
            return redirect()->route('user.cart.index')->with('success', 'Cartón eliminado del carrito con éxito.');
        }
        return redirect()->route('user.cart.index')->with('error', 'El cartón no se encontró en el carrito.');
    }

    public function edit(Cardboard $cardboard)
    {
        $states = State::all();
        return view('admin.cartones.create', compact('cardboard','states'));
    }

    public function update(Request $request, Cardboard $cardboard)
    {
        $request->validate([
           'name' => 'required',
           'price' => 'required',
           'document_number' => 'nullable',
           'state_id' => 'required',
           'group_id' => 'required',
        ]);
        $data = $request->all();
        $cardboard->update($data);
        return redirect()->route('admin.cartones.create')->with('edit', 'El Cartón se ha editado correctamente.');
    }


}
