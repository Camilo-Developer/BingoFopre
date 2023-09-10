<?php

namespace App\Http\Controllers\Admin\CardMains;

use App\Http\Controllers\Controller;
use App\Models\CardMain\CardMain;
use Illuminate\Http\Request;

class CardMainsController extends Controller
{
    public function index()
    {
        $cardmains = CardMain::all();
        return view('admin.cardmains.index',compact('cardmains'));
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
