<?php

namespace App\Http\Controllers\Admin\DynamicGames;

use App\Http\Controllers\Controller;
use App\Models\DynamicGame\DynamicGame;
use Illuminate\Http\Request;

class DynamicGamesController extends Controller
{

    public function index()
    {
        $dynamicgames = DynamicGame::all();
        return view('admin.dynamicgames.index',compact('dynamicgames'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required',
            'title' => 'required',
            'letra' => 'required',
            'fila' => 'nullable',
            'colum' => 'nullable',
        ]);
        $dynamicgames = $request->all();

        if ($request->hasFile('logo')){
            $logo = $request->file('logo');
            $rutaGuardarlogo = public_path('storage/dynamicgames');
            $imagenlogo = date('YmdHis') . '.' . $logo->getClientOriginalExtension();
            $logo->move($rutaGuardarlogo, $imagenlogo);
            $dynamicgames['logo'] = 'dynamicgames/' . $imagenlogo;
        }
        // Verifica si fila y colum están definidos y convierte a JSON si es necesario
        if (isset($dynamicgames['fila'])) {
            $dynamicgames['fila'] = json_encode($dynamicgames['fila']);
        }
        if (isset($dynamicgames['colum'])) {
            $dynamicgames['colum'] = json_encode($dynamicgames['colum']);
        }

        DynamicGame::create($dynamicgames);
        return redirect()->route('admin.dynamicgames.index')->with('success', 'La nueva dinámica se creo correctamente.');
    }

    public function show(DynamicGame $dynamicgame)
    {
        //
    }

    public function edit(DynamicGame $dynamicgame)
    {
        return view('admin.dynamicgames.index',compact('dynamicgame'));
    }

    public function update(Request $request, DynamicGame $dynamicgame)
    {

        $request->validate([
            'logo' => 'nullable',
            'title' => 'required',
            'letra' => 'required',
            'fila' => 'nullable',
            'colum' => 'nullable',
        ]);

        $dynamicgameData = $request->all();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $rutaGuardarlogo = public_path('storage/dynamicgames');
            $imagenlogo = date('YmdHis') . '.' . $logo->getClientOriginalExtension();
            $logo->move($rutaGuardarlogo, $imagenlogo);
            $dynamicgameData['logo'] = 'dynamicgames/' . $imagenlogo;

            if ($dynamicgame->logo) {
                $imagenAnterior = public_path('storage/' . $dynamicgame->logo);
                if (file_exists($imagenAnterior)) {
                    unlink($imagenAnterior);
                }
            }
        } else {
            unset($dynamicgameData['logo']);
        }

        // Verifica si fila y colum están definidos y convierte a JSON si es necesario
        if (isset($dynamicgameData['fila'])) {
            $dynamicgameData['fila'] = json_encode($dynamicgameData['fila']);
        }
        if (isset($dynamicgameData['colum'])) {
            $dynamicgameData['colum'] = json_encode($dynamicgameData['colum']);
        }

        $dynamicgame->update($dynamicgameData);

        return redirect()->route('admin.dynamicgames.index')->with('edit', 'La dinámica del juego se actualizó correctamente.');
    }

    public function destroy(DynamicGame $dynamicgame)
    {
        $dynamicgame->delete();
        return redirect()->route('admin.dynamicgames.index')->with('delete', 'La dinámica del juego se elimino correctamente.');
    }
}
