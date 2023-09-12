<?php

namespace App\Http\Controllers\Admin\Cardboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cardboard\Cardboard;
use App\Models\CartonGroup\CartonGroup;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CardboardsController extends Controller
{
    public function createForm()
    {
        return view('cartones.create');
    }


    public function create(Request $request)
    {
        $startNumber = $request->input('start_number');
        $endNumber = $request->input('end_number');
        $groupSize = $request->input('group_size');
        $date = $request->input('date');

        $user_id = auth()->user()->id; // Obtener el ID del usuario autenticado

        $group = null;
        $groupCount = 0;

        for ($i = $startNumber; $i <= $endNumber; $i++) {
            if ($groupCount  % $groupSize === 0) {
                $group = CartonGroup::create(['user_id' => null]);
            }

            $cardboard = Cardboard::create([
                'name' => $i,
                'date_finish' => $date,
                'state_id' => 1, // Reemplaza con el estado correcto
                'group_id' => $group ? $group->id : null,
                'user_id' => null,
            ]);
            $groupCount++;
            // Asigna el group_id al cartón
            $cardboard->group_id = $group ? $group->id : null;
            $cardboard->save();
        }

        return redirect()->route('cartones.createForm')->with('success', 'Cartones y grupos creados exitosamente.');
    }




}
