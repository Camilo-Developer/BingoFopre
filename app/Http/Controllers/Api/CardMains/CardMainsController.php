<?php

namespace App\Http\Controllers\Api\CardMains;

use App\Http\Controllers\Controller;
use App\Models\CardMain\CardMain;
use Illuminate\Http\Request;

class CardMainsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cardmains = CardMain::all();
            return response()->json($cardmains, 200);
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
            $cardmain = CardMain:: create($request->all());
            return response()->json(['message' => 'La noticia ' . $cardmain->title . ' Se creo correctamente'], 201);
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
            $cardmain = CardMain:: find($id);
            return response()->json($cardmain, 200);
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
            $cardmain = CardMain:: find($id)->update($request->all());
            return response()->json(['message' => 'La noticia Se Edito correctamente'], 202);
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
            $cardmain = CardMain:: find($id)->delete();
            return response()->json(['message' => 'La noticia se elimino Correctamente'], 202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }
    }
}
