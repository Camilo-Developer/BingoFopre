<?php

namespace App\Http\Controllers\Admin\DynamicGames;

use App\Http\Controllers\Controller;
use App\Models\DynamicGame\DynamicGame;
use Illuminate\Http\Request;
use App\Models\State\State;
class DynamicGamesController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.dynamicgames.index')->only('index');
        $this->middleware('can:admin.dynamicgames.edit')->only('edit', 'update');
        $this->middleware('can:admin.dynamicgames.create')->only('create', 'store');
        $this->middleware('can:admin.dynamicgames.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $dynamicgames = DynamicGame::query()
            ->where('title', 'LIKE', "%$search%")
            ->orWhere('letra', 'LIKE', "%$search%")
            ->orWhereHas('state', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->paginate(5);
        $states = State::all();
        return view('admin.dynamicgames.index',compact('dynamicgames','states','search'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required',
            'title' => 'required',
            'letra' => 'nullable',
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
        if (isset($dynamicgames['fila'])) {
            $dynamicgames['fila'] = json_encode($dynamicgames['fila']);
        }
        if (isset($dynamicgames['colum'])) {
            $dynamicgames['colum'] = json_encode($dynamicgames['colum']);
        }

        DynamicGame::create($dynamicgames);
        return redirect()->route('admin.dynamicgames.index')->with('success', 'La nueva dinámica se creo correctamente.');
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
            'letra' => 'nullable',
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
