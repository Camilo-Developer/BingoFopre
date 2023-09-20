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
        $allCartonGroup = CartonGroup::count();
        $allCardboard = Cardboard::count();

        $caronesVendidos = Cardboard::where('state_id',5)->count();

        return view('admin.dashboard.index', compact(
            'users',
            'query',
            'allUser',
            'allCartonGroup',
            'allCardboard',
            'caronesVendidos',
        ));
    }
}
