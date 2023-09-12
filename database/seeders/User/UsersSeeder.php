<?php

namespace Database\Seeders\User;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        
        User::create([
            'name'=> 'Jordy',
            'lastname'=> 'ENP',
            'email'=> 'jordy_enp@lckminnovaty.onmicrosoft.com',
            'password'=> Hash::make('1234'),
            'state_id'=> '1',
            'avatar'=> '',
            'external_id'=> '',
            'external_auth'=> 'Azure',
        ])->assignRole('Admin');
        */
        User::create([
            'name'=> 'Juan',
            'lastname'=> 'Developer',
            'email'=> 'camilo@gmail.com',
            'password'=> Hash::make('1234'),
            'state_id'=> '1',
            'avatar'=> '',
            'external_id'=> '',///
            'external_auth'=> 'Azure',
        ])->assignRole('Admin');
        User::create([
            'name'=> 'Estudiante',
            'lastname'=> 'Uniandes',
            'email'=> 'estudiante@gmail.com',
            'password'=> Hash::make('1234'),
            'state_id'=> '1',
            'avatar'=> '',
            'external_id'=> '',
            'external_auth'=> 'Azure',
        ])->assignRole('Estudiante');
    }
}
