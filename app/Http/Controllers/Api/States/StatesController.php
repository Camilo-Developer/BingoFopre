<?php

namespace App\Http\Controllers\Api\States;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use http\Env\Response;

use App\Models\State\State;


class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $states = State:: all();
            return response()->json($states, 200);
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
            $state = State:: create($request->all());
            return response()->json(['message'=> 'El estado se creo correctamente.'],201);
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
            $state = State:: find($id);
            return response()->json($state, 200);
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
            $state = State:: find($id)->update($request->all());
            return response()->json([ 'message' => 'El estado se actualizó correctamente'],202);
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
            $state = State:: find($id)->delete();
            return response()->json([ 'message' => 'El estado se eliminó correctamente'],202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }
    }


}
