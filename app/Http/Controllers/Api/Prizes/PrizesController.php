<?php

namespace App\Http\Controllers\Api\Prizes;

use App\Http\Controllers\Controller;
use App\Models\Prize\Prize;
use Illuminate\Http\Request;

class PrizesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $prizes = Prize::all();
            return response()->json($prizes, 200);
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
            $prize = Prize:: create($request->all());
            return response()->json(['message' => 'El premio se creo correctamente'], 201);
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
            $prize = Prize:: find($id);
            return response()->json($prize, 200);
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
            $prize = Prize:: find($id)->update($request->all());
            return response()->json(['message' => 'El premio se Edito correctamente'], 202);
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
            $prize = Prize:: find($id)->delete();
            return response()->json(['message' => 'El premio se elimino Correctamente'], 202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }
    }
}
