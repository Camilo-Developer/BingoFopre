<?php

namespace App\Http\Controllers\Api\Sponsors;

use App\Http\Controllers\Controller;
use App\Models\Sponsor\Sponsor;
use Illuminate\Http\Request;

class SponsorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sponsors = Sponsor::all();
            return response()->json($sponsors, 200);
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
            $sponsor = Sponsor:: create($request->all());
            return response()->json(['message' => 'El patrocinador ' . $sponsor->name . ' Se creo correctamente'], 201);
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
            $sponsor = Sponsor:: find($id);
            return response()->json($sponsor, 200);
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
            $sponsor = Sponsor:: find($id)->update($request->all());
            return response()->json(['message' => 'El patrocinador se edito correctamente'], 202);
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
            $sponsor = Sponsor:: find($id)->delete();
            return response()->json(['message' => 'El patrocinador se elimino correctamente'], 202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }
    }
}
