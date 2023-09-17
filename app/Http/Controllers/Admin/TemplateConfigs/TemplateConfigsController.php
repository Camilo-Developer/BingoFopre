<?php

namespace App\Http\Controllers\Admin\TemplateConfigs;

use App\Http\Controllers\Controller;
use App\Models\TemplateConfig\TemplateConfig;
use Illuminate\Http\Request;

class TemplateConfigsController extends Controller
{

    public function __construct(){
        $this->middleware('can:admin.templateconfigs.index')->only('index');
        $this->middleware('can:admin.templateconfigs.edit')->only('edit', 'update');
        $this->middleware('can:admin.templateconfigs.create')->only('create', 'store');
        $this->middleware('can:admin.templateconfigs.destroy')->only('destroy');
    }

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
            'color_main_one' => 'required', //
            'color_main_two' => 'required',
            'img_carton' => 'required',//
            'url_carton' => 'required', //
            'description_carton' => 'required',
            'price_carton' => 'required',
            'img_live' => 'required',
            'url_live' => 'required',
            'description_live' => 'required',
            'area' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'color_text_one' => 'required',
            'color_text_two' => 'required',
            'color_text_three' => 'required',
            'img_login' => 'required',
            'color_login_one' => 'required',
            'color_login_two' => 'required',
            'color_login_hover_three' => 'required',
            'color_login_hover_four' => 'required',
        ]);
        $templateconfigs = $request->all();

        //1
        if ($request->hasFile('logo')){
            $logo = $request->file('logo');
            $rutaGuardarLogo = public_path('storage/templateconfing');
            $imagenLogo = date('YmdHis') . '.' . $logo->getClientOriginalExtension();
            $logo->move($rutaGuardarLogo, $imagenLogo);
            $templateconfigs['logo'] = 'templateconfing/' . $imagenLogo;
        }

        //2
        if ($request->hasFile('img_main')){
            $img_main = $request->file('img_main');
            $rutaGuardarImgMain = public_path('storage/templateconfing');
            $imagenImgMian = date('YmdHis') . '.' . $img_main->getClientOriginalExtension();
            $img_main->move($rutaGuardarImgMain, $imagenImgMian);
            $templateconfigs['img_main'] = 'templateconfing/' . $imagenImgMian;
        }

        //3
        if ($request->hasFile('img_carton')){
            $img_carton = $request->file('img_carton');
            $rutaGuardarImgCarton = public_path('storage/templateconfing');
            $imagenImgCarton = date('YmdHis') . '.' . $img_carton->getClientOriginalExtension();
            $img_carton->move($rutaGuardarImgCarton, $imagenImgCarton);
            $templateconfigs['img_carton'] = 'templateconfing/' . $imagenImgCarton;
        }
        //4
        if ($request->hasFile('img_live')){
            $img_live = $request->file('img_live');
            $rutaGuardarImgLive = public_path('storage/templateconfing');
            $imagenImgLive = date('YmdHis') . '.' . $img_live->getClientOriginalExtension();
            $img_live->move($rutaGuardarImgLive, $imagenImgLive);
            $templateconfigs['img_live'] = 'templateconfing/' . $imagenImgLive;
        }
        //5
        if ($request->hasFile('img_login')){
            $img_login = $request->file('img_login');
            $rutaGuardarImgLogin = public_path('storage/templateconfing');
            $imagenImgLogin = date('YmdHis') . '.' . $img_login->getClientOriginalExtension();
            $img_login->move($rutaGuardarImgLogin, $imagenImgLogin);
            $templateconfigs['img_login'] = 'templateconfing/' . $imagenImgLogin;
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
            'logo' => 'nullable', //
            'img_main' => 'nullable', //
            'color_main_one' => 'required', //
            'color_main_two' => 'required',
            'img_carton' => 'nullable',//
            'url_carton' => 'required', //
            'description_carton' => 'required',
            'price_carton' => 'required',
            'img_live' => 'nullable',
            'url_live' => 'required',
            'description_live' => 'required',
            'area' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'color_text_one' => 'required',
            'color_text_two' => 'required',
            'color_text_three' => 'required',
            'img_login' => 'nullable',
            'color_login_one' => 'required',
            'color_login_two' => 'required',
            'color_login_hover_three' => 'required',
            'color_login_hover_four' => 'required',
        ]);
        $data = $request->all();

        //1
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

        //2
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

        //3
        if ($request->hasFile('img_carton')){
            $img_carton = $request->file('img_carton');
            $rutaGuardarImgCarton = public_path('storage/templateconfing');
            $imagenImgCarton = date('YmdHis') . '.' . $img_carton->getClientOriginalExtension();
            $img_carton->move($rutaGuardarImgCarton, $imagenImgCarton);
            $data['img_carton'] = 'templateconfing/' . $imagenImgCarton;

            if ($templateconfig->img_carton) {
                $imagenAnterior3 = public_path('storage/' . $templateconfig->img_carton);
                if (file_exists($imagenAnterior3)) {
                    unlink($imagenAnterior3);
                }
            }
        } else {
            unset($data['img_carton']);
        }

        //4
        if ($request->hasFile('img_live')){
            $img_live = $request->file('img_live');
            $rutaGuardarImgLive = public_path('storage/templateconfing');
            $imagenImgLive = date('YmdHis') . '.' . $img_live->getClientOriginalExtension();
            $img_live->move($rutaGuardarImgLive, $imagenImgLive);
            $data['img_live'] = 'templateconfing/' . $imagenImgLive;

            if ($templateconfig->img_live) {
                $imagenAnterior4 = public_path('storage/' . $templateconfig->img_live);
                if (file_exists($imagenAnterior4)) {
                    unlink($imagenAnterior4);
                }
            }
        } else {
            unset($data['img_live']);
        }

        //5
        if ($request->hasFile('img_login')){
            $img_login = $request->file('img_login');
            $rutaGuardarImgLogin = public_path('storage/templateconfing');
            $imagenImgLogin = date('YmdHis') . '.' . $img_login->getClientOriginalExtension();
            $img_login->move($rutaGuardarImgLogin, $imagenImgLogin);
            $data['img_login'] = 'templateconfing/' . $imagenImgLogin;

            if ($templateconfig->img_login) {
                $imagenAnterior5 = public_path('storage/' . $templateconfig->img_login);
                if (file_exists($imagenAnterior5)) {
                    unlink($imagenAnterior5);
                }
            }
        } else {
            unset($data['img_login']);
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
