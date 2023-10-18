<?php

namespace Database\Seeders\Instructions;

use App\Models\Instruction\Instruction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instruction::create([
            'description_one'=> 'Lorem ipsum dolor sit amet consectetur adipiscing elit molestie dictumst, class torquent cras sodales metus faucibus mattis magna phasellus',
            'description_two'=> 'Lorem ipsum dolor sit amet consectetur adipiscing elit molestie dictumst, class torquent cras sodales metus faucibus mattis magna phasellus',
        ]);
    }
}
