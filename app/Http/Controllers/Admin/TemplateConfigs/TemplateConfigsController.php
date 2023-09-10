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
            'logo' => 'required', //
            'img_main' => 'required', //
            'url_carton' => 'required', //
            'description_carton' => 'required',
            'price_carton' => 'required',//
            'url_live' => 'required', //
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

    public function edit(TemplateConfig $templateconfig)
    {
        return view('admin.templateconfigs.index',compact('templateconfig'));
    }

    public function update(Request $request, TemplateConfig $templateconfig)
    {
        $request->validate([
            'logo' => 'nullable',
            'img_main' => 'nullable',
            'url_carton' => 'required',
            'description_carton' => 'required',
            'price_carton' => 'required',
            'url_live' => 'required',
            'description_live' => 'required',
            'area' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        $data = $request->all();

        if ($request->hasFile('logo')){
            $logo = $request->file('logo');
            $rutaGuardarLogo = public_path('storage/templateconfing');
            $imagenLogo = date('YmdHis') . '.' . $logo->getClientOriginalExtension();
            $logo->move($rutaGuardarLogo, $imagenLogo);
            $data['logo'] = 'templateconfing/' . $imagenLogo;

            if ($templateconfig->logo) {
                $imagenAnterior = public_path('storage/' . $templateconfig->logo);
                if (file_exists($imagenAnterior)) {
                    unlink($imagenAnterior);
                }
            }
        } else {
            unset($data['logo']);
        }

        if ($request->hasFile('img_main')){
            $img_main = $request->file('img_main');
            $rutaGuardarImgMain = public_path('storage/templateconfing');
            $imagenImgMian = date('YmdHis') . '.' . $img_main->getClientOriginalExtension();
            $img_main->move($rutaGuardarImgMain, $imagenImgMian);
            $data['img_main'] = 'templateconfing/' . $imagenImgMian;

            if ($templateconfig->img_main) {
                $imagenAnterior2 = public_path('storage/' . $templateconfig->img_main);
                if (file_exists($imagenAnterior2)) {
                    unlink($imagenAnterior2);
                }
            }
        } else {
            unset($data['img_main']);
        }

        $templateconfig->update($data);
        return redirect()->route('admin.templateconfigs.index')->with('edit', 'La configuración del aplicativo se edito correctamente.');
    }

    public function destroy(TemplateConfig $templateconfig)
    {
        $templateconfig->delete();
        return redirect()->route('admin.templateconfigs.index')->with('delete', 'La configuración del aplicativo se elimino correctamente.');
    }
}
