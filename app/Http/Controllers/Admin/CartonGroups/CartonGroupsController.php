<?php

namespace App\Http\Controllers\Admin\CartonGroups;

use App\Http\Controllers\Controller;
use App\Models\CartonGroup\CartonGroup;
use App\Models\State\State;
use App\Models\User;
use Illuminate\Http\Request;

class CartonGroupsController extends Controller
{

    public function __construct(){
        $this->middleware('can:admin.cartongroups.index')->only('index');
        $this->middleware('can:admin.cartongroups.edit')->only('edit', 'update');
        $this->middleware('can:admin.cartongroups.create')->only('create', 'store');
        $this->middleware('can:admin.cartongroups.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $users = User::all();
        $states = State::all();
        $search = $request->input('search');

        $cartongroups = CartonGroup::query()
            ->where('id', 'LIKE', "%$search%")
            ->orWhereHas('state', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })
            ->paginate(5);

        $ultimoGrupo = CartonGroup::latest('id')->first();
        $numeroSiguienteGrupo = $ultimoGrupo ? $ultimoGrupo->id + 1 : 1;
        return view('admin.cartongroups.index',compact(
            'cartongroups',
            'users',
            'states',
            'search',
            'numeroSiguienteGrupo'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
           'user_id' => 'nullable',
           'state_id' => 'required',
        ]);
        $cartongroups = $request->all();
        CartonGroup::create($cartongroups);
        return redirect()->route('admin.cartongroups.index')->with('success', 'El grupo de cartones se a creado correctamente.');
    }


    public function edit(CartonGroup $cartongroup)
    {
        $states = State::all();
        return view('admin.cartongroups.index',compact('cartongroup','states'));

    }

    public function update(Request $request, CartonGroup $cartongroup)
    {
        $request->validate([
            'user_id' => 'nullable',
            'state_id' => 'nullable',
        ]);
        $data = $request->all();
        $cartongroup->user_id = $data['user_id'];
        $cartongroup->state_id = $data['state_id'];
        $cartongroup->save();
        return redirect()->route('admin.cartongroups.index')->with('edit', 'El grupo de cartones se ha actualizado correctamente.');
    }

    public function destroy(CartonGroup $cartongroup)
    {
        $hasAssignedCardboards = $cartongroup->cardboard()->exists();
        if ($hasAssignedCardboards) {
            return redirect()->route('admin.cartongroups.index')
                ->with('info', 'No se puede eliminar el grupo de cartones porque contiene cartones asignados.');
        }

        // Si no hay cartones asignados, procede con la eliminación del grupo
        $cartongroup->delete();

        return redirect()->route('admin.cartongroups.index')
            ->with('delete', 'El grupo de cartones se ha eliminado correctamente.');
    }

}
