<?php

namespace App\Http\Controllers\Api\TemplateConfigs;

use App\Http\Controllers\Controller;
use App\Models\TemplateConfig\TemplateConfig;
use Illuminate\Http\Request;

use http\Env\Response;

class TemplateConfigsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $templateconfigs = TemplateConfig:: all();
            return response()->json($templateconfigs, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }

    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public
    function store(Request $request)
    {
        try {
            $templateconfig = TemplateConfig:: create($request->all());
            return response()->json(['message'=> 'Las nuevas configuraciones del sitio se crearón correctamente'],201);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public
    function show(string $id)
    {
        try {
            $templateconfig = TemplateConfig:: find($id);
            return response()->json($templateconfig, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, string $id)
    {
        try {
            $templateconfig = TemplateConfig:: find($id)->update($request->all());
            return response()->json([ 'message' => 'La configuraciones del sitio se editarón correctamente'],202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        try {
            $templateconfig = TemplateConfig:: find($id)->delete();
            return response()->json([ 'message' => 'La configuración del sitio se eliminó correctamente'],202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }
    }
}
