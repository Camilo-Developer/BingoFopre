<?php

namespace App\Http\Controllers\Admin\Prizes;

use App\Http\Controllers\Controller;
use App\Models\Prize\Prize;
use App\Models\State\State;
use Illuminate\Http\Request;

class PrizesController extends Controller
{

    public function __construct(){
        $this->middleware('can:admin.prizes.index')->only('index');
        $this->middleware('can:admin.prizes.edit')->only('edit', 'update');
        $this->middleware('can:admin.prizes.create')->only('create', 'store');
        $this->middleware('can:admin.prizes.destroy')->only('destroy');
    }


    public function index()
    {
        $prizes = Prize::paginate(5);
        $states = State::all();
        return view('admin.prizes.index',compact('prizes', 'states'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required',
            'imagen' => 'required',
            'description' => 'required',
        ]);
        $prizes = $request->all();
        if ($request->hasFile('imagen')){
            $Imagen = $request->file('imagen');
            $rutaGuardarImagen = public_path('storage/prizes');
            $imagenImagen = date('YmdHis') . '.' . $Imagen->getClientOriginalExtension();
            $Imagen->move($rutaGuardarImagen, $imagenImagen);
            $prizes['imagen'] = 'prizes/' . $imagenImagen;
        }
        Prize::create($prizes);
        return redirect()->route('admin.prizes.index')->with('success', 'El premio se creo correctamente.');
    }
    public function edit(Prize $prize)
    {
        return view('admin.prizes.index',compact('prize'));

    }
    public function update(Request $request, Prize $prize)
    {
        $request->validate([
            'color' => 'required',
            'imagen' => 'nullable',
            'description' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('imagen')){
            $Imagen = $request->file('imagen');
            $rutaGuardarImagen = public_path('storage/prizes');
            $imagenImagen = date('YmdHis') . '.' . $Imagen->getClientOriginalExtension();
            $Imagen->move($rutaGuardarImagen, $imagenImagen);
            $data['imagen'] = 'prizes/' . $imagenImagen;

            if ($prize->imagen) {
                $imagenAnterior = public_path('storage/' . $prize->imagen);
                if (file_exists($imagenAnterior)) {
                    unlink($imagenAnterior);
                }
            }
        } else {
            unset($data['imagen']);
        }
        $prize->update($data);
        return redirect()->route('admin.prizes.index')->with('edit', 'El premio se edito correctamente.');
    }
    public function destroy(Prize $prize)
    {
        $prize->delete();
        return redirect()->route('admin.prizes.index')->with('delete', 'El premio se elimino correctamente.');
    }
}
