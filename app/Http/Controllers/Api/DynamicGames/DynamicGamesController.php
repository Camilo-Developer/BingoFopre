<?php

namespace App\Http\Controllers\Api\DynamicGames;

use App\Http\Controllers\Controller;
use App\Models\DynamicGame\DynamicGame;
use Illuminate\Http\Request;

class DynamicGamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $dynamicgames = DynamicGame::all();
            return response()->json($dynamicgames, 200);
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
    public function store(Request $request)
    {
        try {
            $dynamicgame = DynamicGame:: create($request->all());
            return response()->json(['message' => 'La dinamica ' . $dynamicgame->title . ' Se creo correctamente'], 201);
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
            $dynamicgame = DynamicGame:: find($id);
            return response()->json($dynamicgame, 200);
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
            $dynamicgame = DynamicGame:: find($id)->update($request->all());
            return response()->json(['message' => 'La dinamica Se Edito correctamente'], 202);
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
            $dynamicgame = DynamicGame:: find($id)->delete();
            return response()->json(['message' => 'La dinamica se elimino Correctamente'], 202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }
    }
}
