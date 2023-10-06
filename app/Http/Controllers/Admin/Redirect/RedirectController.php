<?php

namespace App\Http\Controllers\Admin\Redirect;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;


class RedirectController extends Controller
{
    public function dashboard(){
        if (auth()->user()->can('admin.dashboard')){
            return redirect()->route('admin.dashboard');
        }elseif (auth()->user()->can('dashboard')){
            return redirect()->route('dashboard');
        }else{
            Auth::logout();
            return redirect()->route('login')->with('info', 'No tiene los permisos requeridos para ingresar al sistema comuniquese con la mesa de ayuda.');
        }
    }

    public function dashboardUser(){
        return view('user.dashboard.index');
    }

    public function azureLogin(Request $request)    {
        return Socialite::driver('azure')->redirect();
    }
    public function azureCallback()
    {
        $user = Socialite::driver('azure')->user();
        $userExists = User::where('external_id', $user->id)
            ->where('external_auth', 'azure')
            ->first();

        if ($userExists) {
            Auth::login($userExists);
        } else {
            $userNew = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'external_id' => $user->id,
                'external_auth' => 'azure',
                'avatar' => $user->avatar,
                'state_id' => '1',
            ])->assignRole('Estudiante');
            Auth::login($userNew);


        }

        return redirect('/redirect');
    }
}
