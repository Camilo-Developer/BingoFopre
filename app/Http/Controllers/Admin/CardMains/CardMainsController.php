<?php

namespace App\Http\Controllers\Admin\CardMains;

use App\Http\Controllers\Controller;
use App\Models\CardMain\CardMain;
use Illuminate\Http\Request;
use App\Models\State\State;

class CardMainsController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.cardmains.index')->only('index');
        $this->middleware('can:admin.cardmains.edit')->only('edit', 'update');
        $this->middleware('can:admin.cardmains.create')->only('create', 'store');
        $this->middleware('can:admin.cardmains.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $cardmains = CardMain::query()
            ->where('title', 'LIKE', "%$search%")
            ->orWhereHas('state', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->paginate(5);
        $states = State::all();

        return view('admin.cardmains.index', compact('cardmains', 'states', 'search'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required',
            'title' => 'required',
            'description' => 'required',
            'mas_info' => 'nullable',
        ]);
        $cardmains = $request->all();
        if ($request->hasFile('imagen')){
            $Imagen = $request->file('imagen');
            $rutaGuardarImagen = public_path('storage/cardmains');
            $imagenImagen = date('YmdHis') . '.' . $Imagen->getClientOriginalExtension();
            $Imagen->move($rutaGuardarImagen, $imagenImagen);
            $cardmains['imagen'] = 'cardmains/' . $imagenImagen;
        }
        CardMain::create($cardmains);
        return redirect()->route('admin.cardmains.index')->with('success', 'La noticia se creo correctamente.');
    }
    public function edit(CardMain $cardmain)
    {
        return view('admin.cardmains.index', compact('cardmain'));
    }
    public function update(Request $request, CardMain $cardmain)
    {
        $request->validate([
            'imagen' => 'nullable',
            'title' => 'required',
            'description' => 'required',
            'mas_info' => 'nullable',
        ]);
        $data = $request->all();
        if ($request->hasFile('imagen')){
            $Imagen = $request->file('imagen');
            $rutaGuardarImagen = public_path('storage/cardmains');
            $imagenImagen = date('YmdHis') . '.' . $Imagen->getClientOriginalExtension();
            $Imagen->move($rutaGuardarImagen, $imagenImagen);
            $data['imagen'] = 'cardmains/' . $imagenImagen;

            if ($cardmain->imagen) {
                $imagenAnterior = public_path('storage/' . $cardmain->imagen);
                if (file_exists($imagenAnterior)) {
                    unlink($imagenAnterior);
                }
            }
        } else {
            unset($data['imagen']);
        }
        $cardmain->update($data);
        return redirect()->route('admin.cardmains.index')->with('edit', 'La noticia se ha actualizado correctamente.');
    }
    public function destroy(CardMain $cardmain)
    {
        $cardmain->delete();
        return redirect()->route('admin.cardmains.index')->with('delete', 'La noticia se ha eliminado correctamente.');
    }
}
