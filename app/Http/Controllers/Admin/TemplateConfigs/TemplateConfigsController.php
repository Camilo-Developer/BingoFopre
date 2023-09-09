<?php

namespace App\Http\Controllers\Admin\TemplateConfigs;

use App\Http\Controllers\Controller;
use App\Models\TemplateConfig\TemplateConfig;
use Illuminate\Http\Request;

class TemplateConfigsController extends Controller
{

    public function index()
    {
        $templateconfigs = TemplateConfig::all();
        return view('admin.templateconfigs.index',compact('templateconfigs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required',
            'img_main' => 'required',
            'url_carton' => 'required',
            'description_carton' => 'required',
            'price_carton' => 'required',
            'url_live' => 'required',
            'description_live' => 'required',
            'area' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $templateconfigs = $request->all();

        if ($request->hasFile('logo')){
            $logo = $request->file('logo');
            $rutaGuardarLogo = public_path('storage/templateconfing');
            $imagenLogo = date('YmdHis') . '.' . $logo->getClientOriginalExtension();
            $logo->move($rutaGuardarLogo, $imagenLogo);
            $templateconfigs['logo'] = 'templateconfing/' . $imagenLogo;
        }

        if ($request->hasFile('img_main')){
            $img_main = $request->file('img_main');
            $rutaGuardarImgMain = public_path('storage/templateconfing');
            $imagenImgMian = date('YmdHis') . '.' . $img_main->getClientOriginalExtension();
            $img_main->move($rutaGuardarImgMain, $imagenImgMian);
            $templateconfigs['img_main'] = 'templateconfing/' . $imagenImgMian;
        }

        TemplateConfig::create($templateconfigs);
        return redirect()->route('admin.templateconfigs.index')->with('success', 'La configuración del aplicativo se creo correctamente.');

    }

    public function show(TemplateConfig $templateConfig)
    {
        //
    }


    public function edit(TemplateConfig $templateConfig)
    {
        //
    }

    public function update(Request $request, TemplateConfig $templateConfig)
    {
        //
    }

    public function destroy(TemplateConfig $templateConfig)
    {
        //
    }
}
