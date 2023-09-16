<?php

namespace App\Http\Controllers\Api\Instructions;

use App\Http\Controllers\Controller;
use App\Models\Instruction\Instruction;
use Illuminate\Http\Request;

class InstructionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $instructions = Instruction::all();
            return response()->json($instructions, 200);
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
            $instruction = Instruction:: create($request->all());
            return response()->json(['message' => 'La instrucción se creo correctamente'], 201);
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
            $instruction = Instruction:: find($id);
            return response()->json($instruction, 200);
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
            $instruction = Instruction:: find($id)->update($request->all());
            return response()->json(['message' => 'La instrucción Se Edito correctamente'], 202);
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
            $instruction = Instruction:: find($id)->delete();
            return response()->json(['message' => 'La instrucción se elimino Correctamente'], 202);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);

        }
    }
}
