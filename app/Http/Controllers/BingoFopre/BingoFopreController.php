<?php

namespace App\Http\Controllers\BingoFopre;

use App\Http\Controllers\Controller;
use App\Models\Cardboard\Cardboard;
use App\Models\CardMain\CardMain;
use App\Models\CartonGroup\CartonGroup;
use App\Models\DynamicGame\DynamicGame;
use App\Models\Instruction\Instruction;
use App\Models\Prize\Prize;
use App\Models\Sponsor\Sponsor;
use App\Models\TemplateConfig\TemplateConfig;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class BingoFopreController extends Controller
{
    public function index(){

        $sponsors = Sponsor::whereHas('state', function ($query) {
            $query->where('check', '=', 1); // Filtra los estados con check = 1
        })->get();


        $cardmains = CardMain::whereHas('state', function ($query) {
            $query->where('check', '=', 1); // Filtra los estados con check = 1
        })->get();


        $templateconfigs = TemplateConfig::all();
        $instructions = Instruction::all();
        return view('bingofopre.index',
        compact(
        'sponsors',
        'cardmains',
            'templateconfigs',
            'instructions'
        ));
    }
    public function instructions(){
        $instructions = Instruction::all();
        $dynamicgames = DynamicGame::whereHas('state', function ($query) {
            $query->where('check', '=', 1); // Filtra los estados con check = 1
        })->get();
        $dynamicgamescount = DynamicGame::whereHas('state', function ($query) {
            $query->where('check', '=', 1); // Filtra los estados con check = 1
        })->count();
        return view('bingofopre.instructions',
            compact(
                'instructions',
                'dynamicgames',
                'dynamicgamescount',
            ));
    }
    public function prizes(){
        $prizes = Prize::whereHas('state', function ($query) {
            $query->where('check', '=', 1); // Filtra los estados con check = 1
        })->get();
        return view('bingofopre.prizes',
            compact(
                'prizes'
            ));
    }
    public function dashboardcartsgroup(){
        // Obtener el usuario autenticado y su user_id
        $user = Auth::user();
        $userId = $user->id;

        // Obtener todos los grupos de cartones
        $card_groups = CartonGroup::where('user_id', $userId)
            ->where('state_id', 3)
            ->get();

        // Inicializar una variable para almacenar la suma total
        $totalCartonesAsignados = 0;
        $totalCartonesVendidos = 0;
        $totalCartonesObsequios = 0;

        // Iterar a través de los grupos de cartones
        foreach ($card_groups as $group) {
            // Calcular el total de cartones asignados para el estado 3 (cursante) en cada grupo y para el usuario actual
            $totalCartones = Cardboard::where('group_id', $group->id)
                ->count();

            $totalCartonesVen = Cardboard::where('group_id', $group->id)
                ->where('state_id', 5)
                ->count();

            $totalCartonesObse = Cardboard::where('group_id', $group->id)
                ->where('state_id', 6)
                ->count();

            // Sumar al total general
            $totalCartonesAsignados += $totalCartones;
            $totalCartonesVendidos += $totalCartonesVen;
            $totalCartonesObsequios += $totalCartonesObse;
        }
        $totalCartonesPendientes = $totalCartonesAsignados - ($totalCartonesVendidos + $totalCartonesObsequios);
         //dd($totalCartonesVendidos); // Puedes usar dd para verificar el total en este punto

        return view('user.dashboard.index', compact('card_groups', 'totalCartonesAsignados', 'totalCartonesVendidos', 'totalCartonesPendientes','totalCartonesObsequios'));
    }






}
