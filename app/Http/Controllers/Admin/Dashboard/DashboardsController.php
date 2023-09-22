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
        $query = $request->input('query'); // Obtén el término de búsqueda desde la URL
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


        // Filtra por fechas si se proporcionan en la solicitud
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $queryBuilder = Cardboard::query();
        $queryBuilders = Cardboard::query();
        if ($startDate && $endDate) {
            $queryBuilder->whereBetween('created_at', [$startDate, $endDate]);
            $queryBuilders->whereBetween('created_at', [$startDate, $endDate]);
        }
        $cartonFilter = $queryBuilder->count(); // Contar cartones filtrados por fecha

        // Contar cartones vendidos filtrados por fecha
        $caronesVendidosFilter = $queryBuilder->where('state_id', 5)->count();

        // Consulta separada para contar cartones obsequio filtrados por fecha
        $caronesObsequioFilter = $queryBuilders->where('state_id', 6)->count();


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
            'caronesObsequioFilter'
        ));
    }
}