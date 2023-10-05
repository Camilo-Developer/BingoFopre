<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Cardboard\Cardboard;
use App\Models\CartonGroup\CartonGroup;
use App\Models\State\State;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

use Spatie\Permission\Models\Role;


class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit', 'update');
        $this->middleware('can:admin.users.show')->only('show');
        $this->middleware('can:admin.users.create')->only('create', 'store');
        $this->middleware('can:admin.users.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->where('name', 'LIKE', "%$search%")
            ->orWhere('lastname', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->paginate(5);
        $states = State::all();
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'search', 'states', 'roles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => ['required', 'email', Rule::unique('users')], // Verifica unicidad del correo electrónico en la tabla 'users'
            'password' => 'required',
            'state_id' => 'required',
            'roles' => ['required', 'array', 'min:1'],
        ]);
        User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'state_id' => $request->state_id,
        ])->roles()->sync($request->roles);
        return redirect()->route('admin.users.index')->with('success', 'El Usuario se ha creado correctamente.');
    }
    public function show(User $user)
    {
        $states = State::all();
        $roles = Role::all();
        $roles_user = [];
        foreach ($user->roles as $role_user){
            array_push($roles_user, $role_user->id);
        }
        $grupo_cartones = CartonGroup::where('user_id', null)
            ->where('state_id', 3)
            ->withCount([
                'cardboard',
                'cardboard as cardboards_vendidos' => function ($query) {
                    $query->where('state_id', 5);
                },
                'cardboard as cardboards_obsequio' => function ($query) {
                    $query->where('state_id', 6);
                },
            ])
            ->get();

        $card_groups = CartonGroup::where('user_id', $user->id)
            ->where('state_id', 3)
            ->withCount([
                'cardboard',
                'cardboard as cardboards_vendidos' => function ($query) {
                    $query->where('state_id', 5);
                },
                'cardboard as cardboards_obsequio' => function ($query) {
                    $query->where('state_id', 6);
                },
            ])
            ->with(['cardboard' => function ($query) {
                $query->select('id', 'name', 'state_id', 'group_id');
            }])
            ->paginate(5);


        $currentYear = date('Y');

        $card_groups_shows = CartonGroup::where('user_id', $user->id)
            ->whereYear('created_at', $currentYear)
            ->withCount([
                'cardboard',
                'cardboard as cardboards_vendidos' => function ($query) {
                    $query->where('state_id', 5);
                },
                'cardboard as cardboards_obsequio' => function ($query) {
                    $query->where('state_id', 6);
                },
            ])
            ->with(['cardboard' => function ($query) {
                $query->select('id', 'name', 'state_id', 'group_id');
            }])
            ->get();

        $totalGruposAsignados = CartonGroup::where('user_id', $user->id)
            ->where('state_id', 3)
            ->count();
        // Inicializar una variable para almacenar la suma total
        $totalCartonesAsignados = 0;
        $totalCartonesVendidos = 0;
        $totalCartonesObsequios = 0;
        $totalMontoVendido = 0;
        $totalMontoGrupo = 0;
        $totalMontoObsequio = 0;

        // Iterar a través de los grupos de cartones
        foreach ($card_groups as $group) {
            // Calcular el total de cartones asignados para el estado 3 (cursante) en cada grupo y para el usuario actual
            $totalCartones = Cardboard::where('group_id', $group->id)
                ->count();

            $totalCartonesVen = Cardboard::where('group_id', $group->id)
                ->where('state_id', 5)
                ->count();

            $montoVendido = Cardboard::where('group_id', $group->id)
                ->where('state_id', 5)
                ->sum('price');

            $montoGrupo = Cardboard::where('group_id', $group->id)
                ->sum('price');

            $montoObsequio = Cardboard::where('group_id', $group->id)
                ->where('state_id', 6)
                ->sum('price');

            $totalCartonesObse = Cardboard::where('group_id', $group->id)
                ->where('state_id', 6)
                ->count();

            // Sumar al total general
            $totalCartonesAsignados += $totalCartones;
            $totalCartonesVendidos += $totalCartonesVen;
            $totalMontoVendido += $montoVendido; // Sumar el monto vendido al total general
            $totalMontoGrupo += $montoGrupo; // Sumar el monto vendido al total general
            $totalMontoObsequio += $montoObsequio; // Sumar el monto vendido al total general
            $totalCartonesObsequios += $totalCartonesObse;

        }

        $totalCartonesPendientes = $totalCartonesAsignados - ($totalCartonesVendidos + $totalCartonesObsequios);

        $sumademontos = $totalMontoVendido + $totalMontoObsequio;

        return view('admin.users.show', compact(
            'user',
            'card_groups',
            'roles_user',
            'roles',
            'totalCartonesAsignados',
            'totalCartonesVendidos',
            'totalCartonesPendientes',
            'totalCartonesObsequios',
            'totalMontoVendido',
            'totalGruposAsignados',
            'totalMontoGrupo',
            'totalMontoObsequio',
            'sumademontos',
            'grupo_cartones',
            'states',
            'card_groups_shows',
            'currentYear',
        ));
    }

    public function edit(User $user)
    {
        $states = State::all();
        $roles = Role::all();
        $roles_user = [];
        foreach ($user->roles as $role_user){
            array_push($roles_user, $role_user->id);
        }
        return view('admin.users.index', compact('user','states', 'roles','roles_user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => ['required', 'email'], // Verifica unicidad del correo electrónico en la tabla 'users'
            'state_id' => 'required',
            'roles' => ['required', 'array', 'min:1'],
        ]);
        $data = $request->all();

        // Verificar si se proporcionó una nueva contraseña
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Eliminar la clave "password" del array si no se proporcionó una nueva contraseña
            unset($data['password']);
        }

        $user->update($data);
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.index')->with('edit', 'El Usuario se ha editado correctamente.');

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('delete', 'El Usuario se ha eliminado correctamente.');
    }

    public function asiginacionGrupos(Request $request)
    {
        // Obtén el ID del usuario que deseas asignar a los grupos de cartones
        $user_id = $request->input('user_id');

        // Obtén los IDs de los grupos de cartones seleccionados en el formulario
        $grupo_cartones_ids = $request->input('grupo_cartones');

        if (!is_null($grupo_cartones_ids) && count($grupo_cartones_ids) > 0) {
            // Obtén el usuario
            $user = User::find($user_id);

            // Asigna el usuario a los grupos de cartones seleccionados
            foreach ($grupo_cartones_ids as $grupo_id) {
                $cartonGroup = CartonGroup::find($grupo_id);

                // Asigna el usuario al grupo de cartones
                $cartonGroup->user_id = $user_id;
                $cartonGroup->save();
            }

            // Redirecciona de regreso a la página anterior o realiza alguna otra acción
            return redirect()->back()->with('success', 'Usuario asignado a los grupos de cartones exitosamente.');
        } else {
            // Si $grupo_cartones_ids está vacío, muestra un mensaje de alerta
            return redirect()->back()->with('info', 'La asignación de grupos no puede estar vacía.');
        }
    }

    public function cambioStateGruposCartones(Request $request) {
        // Obtén el ID del usuario y los grupos de cartones seleccionados desde la solicitud
        $user_id = $request->input('user_id');
        $grupo_cartones_ids = $request->input('state_groups');

        // Verifica si hay grupos de cartones seleccionados
        if (!$grupo_cartones_ids) {
            return redirect()->back()->with('info', 'No se han seleccionado grupos de cartones para cambiar el estado.');
        }

        // Actualiza el estado de los grupos de cartones seleccionados
        CartonGroup::whereIn('id', $grupo_cartones_ids)
            ->update(['state_id' => 5]); // Cambia el estado a 5 (Vendido) o el estado deseado

        return redirect()->back()->with('success', 'Estado de los grupos de cartones actualizado correctamente.');
    }



}
