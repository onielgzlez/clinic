<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            array('name'=>'Administrador','desc'=>'Admin site'),
            array('name'=>'Administrador clínica','desc'=>'Admin clinic'),
            array('name'=>'Doctor','desc'=>'Doctor'),
            array('name'=>'Secretaria','desc'=>'Secretaria'),
            array('name'=>'Contadora','desc'=>'Contadora'),
        );

        for ($i = 0; $i < count($roles); $i++) { 
            DB::table('roles')->insert([
                'name' => $roles[$i]['name'],
                'description' => $roles[$i]['desc'],
            ]);
        }        
       
       $userId = DB::table('users')->insertGetId([
            'first_name' => 'Administrador',
            'last_name' => 'Administrador',
            'last_name2' => 'Administrador',
            'email' => 'medic20@gmail.com',
            'password' => Hash::make('medic2021'),
            'email_verified_at' => now(),
            'document' => Str::random(10),
            'status' => 1,
            'type' => 'user',
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        DB::table('user_roles')->insert([
            'user_id' => $userId,
            'role_id' => 1,
        ]);
    }
}
