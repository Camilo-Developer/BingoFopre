<?php

namespace App\Http\Controllers\BingoFopre;

use App\Http\Controllers\Controller;
use App\Models\CardMain\CardMain;
use App\Models\DynamicGame\DynamicGame;
use App\Models\Instruction\Instruction;
use App\Models\Prize\Prize;
use App\Models\Sponsor\Sponsor;
use App\Models\TemplateConfig\TemplateConfig;
use Illuminate\Http\Request;


class BingoFopreController extends Controller
{
    public function index(){

        $sponsors = Sponsor::all();


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
        $dynamicgames = DynamicGame::all();
        $dynamicgamescount = DynamicGame::count();
        return view('bingofopre.instructions',
            compact(
                'instructions',
                'dynamicgames',
                'dynamicgamescount',
            ));
    }
    public function prizes(){
        $prizes = Prize::all();
        return view('bingofopre.prizes',
            compact(
                'prizes'
            ));
    }
}
