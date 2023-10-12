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
            $query->where('check', '=', 1);
        })->get();
        $cardmains = CardMain::whereHas('state', function ($query) {
            $query->where('check', '=', 1);
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
            $query->where('check', '=', 1);
        })->get();
        $dynamicgamescount = DynamicGame::whereHas('state', function ($query) {
            $query->where('check', '=', 1);
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
            $query->where('check', '=', 1);
        })->get();
        return view('bingofopre.prizes',
            compact(
                'prizes'
            ));
    }

    public function dashboardcartsgroup(){
        $user = Auth::user();
        $userId = $user->id;

        $user_document = Auth::user()->document_number;




        $totalCartonesAsignados = 0;
        $totalCartonesVendidos = 0;
        $totalCartonesObsequios = 0;

        $totalMontoVendido = 0;
        $totalMontoGrupo = 0;
        $totalMontoObsequio = 0;


        $currentYear = date('Y');

        $card_groups_shows = CartonGroup::where('user_id', $userId)
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

        $card_groups = CartonGroup::where('user_id', $userId)
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


        $carton_document_users = Cardboard::where('document_number', $user_document)
            ->whereNotNull('document_number')
            ->paginate(5);

        //dd($carton_document_user);

        $comprasPorDia = Cardboard::where('document_number', $user_document)
            ->whereNotNull('document_number')
            ->selectRaw('DATE(updated_at) as fecha, COUNT(*) as total_cartones')
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();



        $carton_document_users_total = Cardboard::where('document_number', $user_document)
            ->whereNotNull('document_number')
            ->count();

        $carton_document_users_vendidos = Cardboard::where('document_number', $user_document)
            ->where('state_id',5)
            ->whereNotNull('document_number')
            ->count();

        $carton_document_users_obsequio = Cardboard::where('document_number', $user_document)
            ->where('state_id',6)
            ->whereNotNull('document_number')
            ->count();


        //dd($carton_document_users_total,$carton_document_users_vendidos,$carton_document_users_obsequio);

        $date_sold_user_requireds = now();

        $date_sold_user_requireds = date('Y-m-d', strtotime($date_sold_user_requireds));

        foreach ($card_groups as $group) {
            $totalCartones = Cardboard::where('group_id', $group->id)
                ->whereNull('user_id')
                ->count();

            $totalCartonesVen = Cardboard::where('group_id', $group->id)
                ->where('state_id', 5)
                ->where('user_id', $userId)
                ->where('sold_date', $date_sold_user_requireds)
                ->count();

            $totalCartonesObse = Cardboard::where('group_id', $group->id)
                ->where('state_id', 6)
                ->where('user_id', $userId)
                ->where('sold_date', $date_sold_user_requireds)
                ->count();


            $montoVendido = Cardboard::where('group_id', $group->id)
                ->where('state_id', 5)
                ->where('user_id', $userId)
                ->where('sold_date', $date_sold_user_requireds)
                ->sum('price');

            $montoGrupo = Cardboard::where('group_id', $group->id)
                ->whereNull('user_id')
                ->sum('price');

            $montoObsequio = Cardboard::where('group_id', $group->id)
                ->where('state_id', 6)
                ->where('user_id', $userId)
                ->where('sold_date', $date_sold_user_requireds)
                ->sum('price');

            $totalCartonesAsignados += $totalCartones;
            $totalCartonesVendidos += $totalCartonesVen;
            $totalCartonesObsequios += $totalCartonesObse;
            $totalMontoVendido += $montoVendido; // Sumar el monto vendido al total general
            $totalMontoGrupo += $montoGrupo; // Sumar el monto vendido al total general
            $totalMontoObsequio += $montoObsequio; // Sumar el monto vendido al total general
        }
        //dd($totalMontoObsequio);

        $totalCartonesPendientes = $totalCartonesAsignados - ($totalCartonesVendidos + $totalCartonesObsequios);
        $sumademontos = $totalMontoVendido + $totalMontoObsequio;

        return view('user.dashboard.index', compact(
            'card_groups',
            'totalCartonesAsignados',
            'totalCartonesVendidos',
            'totalCartonesPendientes',
            'totalCartonesObsequios',
            'totalMontoVendido',
            'totalMontoGrupo',
            'totalMontoObsequio',
            'sumademontos',
            'card_groups_shows',
            'currentYear',
            'card_groups',
            'carton_document_users',
            'comprasPorDia',
            'carton_document_users_total',
            'carton_document_users_vendidos',
            'carton_document_users_obsequio',

        ));
    }

}
