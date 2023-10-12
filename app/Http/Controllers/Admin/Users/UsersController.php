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

use Illuminate\Database\QueryException;


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
        $user_view_carton = $user->id;

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
                $query->select('id', 'name', 'state_id', 'group_id','sold_date','user_id');
            }])
            ->get();

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

        $card_groups_shows_total = CartonGroup::where('user_id', $user->id)
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
            ->get(5);

        //dd($card_groups_shows_total);

        $totalGruposAsignados = CartonGroup::where('user_id', $user->id)
            ->where('state_id', 3)
            ->count();
        // Inicializar una variable para almacenar la suma total
        $totalCartonesAsignados = 0;
        $totalCartonesAsignados_sin_filtro = 0;
        $totalCartonesVendidos = 0;
        $totalCartonesObsequios = 0;
        $totalMontoVendido = 0;
        $totalMontoGrupo = 0;
        $totalMontoObsequio = 0;


        $date_sold_user_requireds = now();

        $date_sold_user_requireds = date('Y-m-d', strtotime($date_sold_user_requireds));
        //dd($date_sold_user_requireds);

        // Iterar a través de los grupos de cartones
        foreach ($card_groups as $group) {
            // Calcular el total de cartones asignados para el estado 3 (cursante) en cada grupo y para el usuario actual
            $totalCartones = Cardboard::where('group_id', $group->id)
                ->whereNull('user_id')
                ->count();
            //dd($totalCartones);

            $totalCartones_2 = Cardboard::where('group_id', $group->id)
                ->where(function ($query) use ($user_view_carton) {
                    $query->where('user_id', $user_view_carton)
                        ->orWhereNull('user_id');
                })
                ->count();

            $totalCartonesVen = Cardboard::where('group_id', $group->id)
                ->where('state_id', 5)
                ->where('user_id', $user_view_carton)
                ->where('sold_date', $date_sold_user_requireds)
                ->count();


            $montoVendido = Cardboard::where('group_id', $group->id)
                ->where('state_id', 5)
                ->where('user_id', $user_view_carton)
                ->where('sold_date', $date_sold_user_requireds)
                ->sum('price');




            //dd($montoVendido);

            $montoGrupo = Cardboard::where('group_id', $group->id)
                ->whereNull('user_id')
                //->where('sold_date', $date_sold_user_requireds)
                ->sum('price');

            $montoObsequio = Cardboard::where('group_id', $group->id)
                ->where('state_id', 6)
                ->where('user_id', $user_view_carton)
                ->where('sold_date', $date_sold_user_requireds)
                ->sum('price');

            $totalCartonesObse = Cardboard::where('group_id', $group->id)
                ->where('state_id', 6)
                ->where('user_id', $user_view_carton)
                ->where('sold_date', $date_sold_user_requireds)
                ->count();

            // Sumar al total general
            $totalCartonesAsignados += $totalCartones;
            $totalCartonesAsignados_sin_filtro += $totalCartones_2;
            $totalCartonesVendidos += $totalCartonesVen;
            $totalMontoVendido += $montoVendido; // Sumar el monto vendido al total general
            $totalMontoGrupo += $montoGrupo; // Sumar el monto vendido al total general
            $totalMontoObsequio += $montoObsequio; // Sumar el monto vendido al total general
            $totalCartonesObsequios += $totalCartonesObse;




        }

        $totalCartonesPendientes = $totalCartonesAsignados - ($totalCartonesVendidos + $totalCartonesObsequios);

        $sumademontos = $totalMontoVendido + $totalMontoObsequio;


        $montoVendido_usuario_por_dia = Cardboard::where('state_id', 5)
            ->where('user_id', $user_view_carton)
            ->groupBy('sold_date') // Agrupa por fecha de venta
            ->selectRaw('sold_date, sum(price) as total_monto') // Suma los montos de cada grupo
            ->orderBy('sold_date', 'asc') // Ordena por fecha de venta
            ->get();

        $montoVendido_usuario_por_dia_obsequio = Cardboard::where('state_id', 6)
            ->where('user_id', $user_view_carton)
            ->groupBy('sold_date') // Agrupa por fecha de venta
            ->selectRaw('sold_date, sum(price) as total_monto') // Suma los montos de cada grupo
            ->orderBy('sold_date', 'asc') // Ordena por fecha de venta
            ->get();

        $montoVendido_total_dia = Cardboard::where('user_id', $user_view_carton)
            ->groupBy('sold_date') // Agrupa por fecha de venta
            ->selectRaw('sold_date, sum(price) as total_monto') // Suma los montos de cada grupo
            ->orderBy('sold_date', 'asc') // Ordena por fecha de venta
            ->get();

        $cartonesVendidosPorDia = Cardboard::where('user_id', $user_view_carton)
            ->groupBy('sold_date') // Agrupa por fecha de venta
            ->selectRaw('sold_date, count(*) as total_cartones_vendidos') // Cuenta la cantidad de cartones vendidos por día
            ->orderBy('sold_date', 'asc') // Ordena por fecha de venta
            ->get();


        $cartones_usuario_vendidos_por_dia = Cardboard::where('state_id', 5)
            ->where('user_id', $user_view_carton)
            ->groupBy('sold_date') // Agrupa por fecha de venta
            ->selectRaw('sold_date, count(*) as total_cartones_vendidos') // Cuenta la cantidad de cartones vendidos por día
            ->orderBy('sold_date', 'asc') // Ordena por fecha de venta
            ->get();

        $cartones_usuario_obsequio_por_dia = Cardboard::where('state_id', 6)
            ->where('user_id', $user_view_carton)
            ->groupBy('sold_date') // Agrupa por fecha de venta
            ->selectRaw('sold_date, count(*) as total_cartones_vendidos') // Cuenta la cantidad de cartones vendidos por día
            ->orderBy('sold_date', 'asc') // Ordena por fecha de venta
            ->get();



        $cartonesVendidosPorUsuario = Cardboard::where('user_id', $user_view_carton)
            ->get();
        $numero_cartonesVendidosPorUsuario = Cardboard::where('user_id', $user_view_carton)
            ->count();
        //dd($numero_cartonesVendidosPorUsuario);


        //dd($montoVendido_usuario_por_dia);



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
            'totalCartonesAsignados_sin_filtro',
            'montoVendido_usuario_por_dia',
            'montoVendido_usuario_por_dia_obsequio',
            'montoVendido_total_dia',
            'cartonesVendidosPorDia',
            'cartones_usuario_vendidos_por_dia',
            'cartones_usuario_obsequio_por_dia',
            'cartonesVendidosPorUsuario',
            'numero_cartonesVendidosPorUsuario',
            'card_groups_shows_total'
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
            'lastname' => 'nullable',
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
        try {
            $user->delete();
            return redirect()->route('admin.users.index')->with('delete', 'El Usuario se ha eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1451) {
                return redirect()->route('admin.users.index')->with('info', 'El Usuario no se puede eliminar, ya que está relacionado con otros registros.');
            }
        }
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
        // Obtén el ID del usuario desde la solicitud
        $user_id = $request->input('user_id');

        // Obtén los grupos de cartones y sus estados seleccionados
        $state_groups = $request->input('state_groups');

        if (empty($state_groups)) {
            return redirect()->back()->with('info', 'No se ha seleccionado una opción para cambiar el estado.');
        }

        // Itera sobre los grupos de cartones y actualiza sus estados según las opciones seleccionadas
        foreach ($state_groups as $state_group) {
            // Divide la opción seleccionada para obtener el id del grupo y el estado
            list($carton_group_id, $option) = explode('_', $state_group);

            // Actualiza el estado del grupo de cartones según la opción seleccionada
            if ($option === 'vendido') {
                CartonGroup::where('id', $carton_group_id)
                    ->update(['state_id' => 5]);
            } elseif ($option === 'devolucion') {
                CartonGroup::where('id', $carton_group_id)
                    ->update(['state_id' => 3, 'user_id' => null]);
            }
        }

        return redirect()->back()->with('success', 'Estados de los grupos de cartones actualizados correctamente.');
    }



}
