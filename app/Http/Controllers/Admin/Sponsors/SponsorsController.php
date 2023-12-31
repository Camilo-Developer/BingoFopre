<?php

namespace App\Http\Controllers\Admin\Sponsors;

use App\Http\Controllers\Controller;
use App\Models\Sponsor\Sponsor;
use Illuminate\Http\Request;
use App\Models\State\State;
class SponsorsController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.sponsors.index')->only('index');
        $this->middleware('can:admin.sponsors.edit')->only('edit', 'update');
        $this->middleware('can:admin.sponsors.create')->only('create', 'store');
        $this->middleware('can:admin.sponsors.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $sponsors = Sponsor::query()
            ->where('name', 'LIKE', "%$search%")
            ->orWhereHas('state', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->paginate(5);
        $states = State::all();
        return view('admin.sponsors.index',compact('sponsors', 'states','search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required',
            'name' => 'required',
        ]);
        $sponsors = $request->all();

        if ($request->hasFile('logo')){
            $logo = $request->file('logo');
            $rutaGuardarlogo = public_path('storage/sponsors');
            $imagenlogo = date('YmdHis') . '.' . $logo->getClientOriginalExtension();
            $logo->move($rutaGuardarlogo, $imagenlogo);
            $sponsors['logo'] = 'sponsors/' . $imagenlogo;
        }
        Sponsor::create($sponsors);
        return redirect()->route('admin.sponsors.index')->with('success', 'El patrocinio se creo correctamente.');
    }

    public function edit(Sponsor $sponsor)
    {
        return view('admin.sponsors.index',compact('sponsor'));
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        $request->validate([
            'logo' => 'nullable',
            'name' => 'required',
        ]);
        $data = $request->all();

        if ($request->hasFile('logo')){
            $logo = $request->file('logo');
            $rutaGuardarlogo = public_path('storage/sponsors');
            $imagenlogo = date('YmdHis') . '.' . $logo->getClientOriginalExtension();
            $logo->move($rutaGuardarlogo, $imagenlogo);
            $data['logo'] = 'sponsors/' . $imagenlogo;

            if ($sponsor->logo) {
                $imagenAnterior = public_path('storage/' . $sponsor->logo);
                if (file_exists($imagenAnterior)) {
                    unlink($imagenAnterior);
                }
            }
        } else {
            unset($data['logo']);
        }
        $sponsor->update($data);
        return redirect()->route('admin.sponsors.index')->with('edit', 'El patrocinio se ha editado correctamente.');

    }

    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();
        return redirect()->route('admin.sponsors.index')->with('delete', 'El patrocinio se ha elimindado correctamente.');
    }
}
