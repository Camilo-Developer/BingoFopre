<?php

namespace App\Http\Controllers\BingoFopre;

use App\Http\Controllers\Controller;
use App\Models\CardMain\CardMain;
use App\Models\Instruction\Instruction;
use App\Models\Prize\Prize;
use App\Models\Sponsor\Sponsor;
use App\Models\TemplateConfig\TemplateConfig;
use Illuminate\Http\Request;


class BingoFopreController extends Controller
{
    public function index(){

        $sponsors = Sponsor::all();
        $cardmains = CardMain::all();
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
        return view('bingofopre.instructions',
            compact(
                'instructions'
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
