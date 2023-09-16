<?php

namespace App\Http\Controllers\Api\CartonGroups;

use App\Http\Controllers\Controller;
use App\Models\CartonGroup\CartonGroup;
use Illuminate\Http\Request;

class CartonGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cartonGroups = CartonGroup::all();
            return response()->json($cartonGroups, 200);
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
            $cartonGroup = CartonGroup:: create($request->all());
            return response()->json(['message' => 'El grupo se creo correctamente'], 201);
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
            $cartonGroup = CartonGroup:: find($id);
            return response()->json($cartonGroup, 200);
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
            $cartonGroup = CartonGroup:: find($id)->update($request->all());
            return response()->json(['message' => 'El grupo se edito correctamente'], 202);
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
            $cartonGroup = CartonGroup:: find($id)->delete();
            return response()->json(['message' => 'El grupo se elimino Correctamente'], 202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }
    }
}
