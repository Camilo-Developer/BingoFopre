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
        if (auth()->user()->can('dashboard')){
            return redirect()->route('dashboard');
        }elseif (auth()->user()->hasRole('Usuario')){
            return redirect('/');
        }else{
            Auth::logout();
            return redirect()->route('login');
        }
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
            ])->assignRole('Usuario');
            Auth::login($userNew);


        }

        return redirect('/redirect');
    }
}
