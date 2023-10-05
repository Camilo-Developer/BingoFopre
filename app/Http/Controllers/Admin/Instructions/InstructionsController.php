<?php

namespace App\Http\Controllers\Admin\Instructions;

use App\Http\Controllers\Controller;
use App\Models\Instruction\Instruction;
use Illuminate\Http\Request;

class InstructionsController extends Controller
{
    public function __construct(){
        $this->middleware('can:admin.instructions.index')->only('index');
        $this->middleware('can:admin.instructions.edit')->only('edit', 'update');
        $this->middleware('can:admin.instructions.create')->only('create', 'store');
        $this->middleware('can:admin.instructions.destroy')->only('destroy');
    }

    public function index()
    {
        $instructions = Instruction::all();
        return view('admin.instructions.index',compact('instructions'));
    }
    public function edit(Instruction $instruction)
    {
        return view('admin.instructions.index',compact('instruction'));
    }
    public function update(Request $request, Instruction $instruction)
    {
        $request->validate([
           'description_one' => 'required',
           'description_two' => 'required',
        ]);
        $data = $request->all();
        $instruction->update($data);
        return redirect()->route('admin.instructions.index')->with('edit', 'Las instrucciones se editaron correctamente');
    }
}
