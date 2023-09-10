<?php

namespace App\Http\Controllers\Admin\Cardboards;

use App\Http\Controllers\Controller;
use App\Models\Cardboard\Cardboard;
use Illuminate\Http\Request;

class CardboardsController extends Controller
{
    public function createForm()
    {
        return view('cartones.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'start_number' => 'required|integer|min:1',
            'end_number' => 'required|integer|min:' . $request->input('start_number'),
            'date_finish' => 'required|date',
        ]);

        $startNumber = $request->input('start_number');
        $endNumber = $request->input('end_number');
        $fechaFinalizacion = $request->input('date_finish');

        for ($i = $startNumber; $i <= $endNumber; $i++) {
            Cardboard::create([
                'name' => str_pad($i, 9, '0', STR_PAD_LEFT), // Formato 001, 002, ..., 1000
                'date_finish' => $fechaFinalizacion,
            ]);
        }

        return redirect()->route('cartones.createForm')->with('success', 'Se crearon los cartones correctamente.');
    }

}
