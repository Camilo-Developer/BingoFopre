<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cardboard\Cardboard;
use App\Models\CartonGroup\CartonGroup;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardsController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('email', 'like', "%$query%")
            ->orWhere('name', 'like', "%$query%")
            ->orWhere('lastname', 'like', "%$query%")
            ->get();
        $allUser = User::count();
        $year = date('Y');
        $allCartonGroup = CartonGroup::whereYear('created_at', $year)->count();
        $allCardboard = Cardboard::whereYear('created_at', $year)->count();

        $caronesVendidos = Cardboard::whereYear('created_at', $year)->where('state_id', 5)->count();
        $caronesObsequio = Cardboard::whereYear('created_at', $year)->where('state_id', 6)->count();

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $queryBuilder = Cardboard::query();
        $queryBuilders = Cardboard::query();
        if ($startDate && $endDate) {
            $queryBuilder->whereBetween('created_at', [$startDate, $endDate]);
            $queryBuilders->whereBetween('created_at', [$startDate, $endDate]);
        }
        $cartonFilter = $queryBuilder->count();
        $caronesVendidosFilter = $queryBuilder->where('state_id', 5)->count();
        $caronesObsequioFilter = $queryBuilders->where('state_id', 6)->count();

        $total_cartones_obsequio_y_vendidos = Cardboard::whereYear('created_at', $year)
            ->whereNotNull('sold_date')
            ->groupBy('sold_date')
            ->selectRaw('sold_date, count(*) as total_cartones_vendidos')
            ->orderBy('sold_date', 'asc')
            ->get();
        $total_cartones_vendidos_users = Cardboard::where('state_id',5)
            ->whereYear('created_at', $year)
            ->groupBy('sold_date')
            ->selectRaw('sold_date, count(*) as total_cartones_vendidos')
            ->orderBy('sold_date', 'asc')
            ->get();
        $total_cartones_obsequio_users = Cardboard::where('state_id',6)
            ->whereYear('created_at', $year)
            ->groupBy('sold_date')
            ->selectRaw('sold_date, count(*) as total_cartones_vendidos')
            ->orderBy('sold_date', 'asc')
            ->get();

        $montoVendido_total_dia = Cardboard::whereYear('created_at', $year)
            ->whereNotNull('sold_date')
            ->groupBy('sold_date')
            ->selectRaw('sold_date, sum(price) as total_monto')
            ->orderBy('sold_date', 'asc')
            ->get();

        $monto_Vendido_total_dia = Cardboard::where('state_id',5)
            ->whereYear('created_at', $year)
            ->groupBy('sold_date')
            ->selectRaw('sold_date, sum(price) as total_monto')
            ->orderBy('sold_date', 'asc')
            ->get();

        $monto_Obsequio_total_dia = Cardboard::where('state_id',6)
            ->whereYear('created_at', $year)
            ->groupBy('sold_date')
            ->selectRaw('sold_date, sum(price) as total_monto')
            ->orderBy('sold_date', 'asc')
            ->get();

        //dd($monto_Obsequio_total_dia);


        return view('admin.dashboard.index', compact(
            'users',
            'query',
            'allUser',
            'allCartonGroup',
            'allCardboard',
            'caronesObsequio',
            'caronesVendidos',
            'startDate',
            'endDate',
            'cartonFilter',
            'caronesVendidosFilter',
            'year',
            'caronesObsequioFilter',
            'total_cartones_obsequio_y_vendidos',
            'total_cartones_vendidos_users',
            'total_cartones_obsequio_users',
            'montoVendido_total_dia',
            'monto_Vendido_total_dia',
            'monto_Obsequio_total_dia',
        ));
    }
}
