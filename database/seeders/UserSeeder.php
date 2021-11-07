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
            array('name'=>'Especialista','desc'=>'Especialista'),
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

        foreach (range(2,25) as $i) {
            $userId1 = DB::table('users')->insertGetId([
                'first_name' => Str::random(10),
                'last_name' => Str::random(10),
                'last_name2' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('medic2021'),
                'email_verified_at' => now(),
                'document' => Str::random(10),
                'status' => rand(1,3),
                'city_id' => rand(1,50),
                'area_job_id' => rand(1,5),
                'type' => 'worker',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            
            DB::table('user_roles')->insert([
                'user_id' => $userId1,
                'role_id' => rand(2,4),
            ]);

            DB::table('organizations')->insert([
                'name' => Str::random(10),
                'slug' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'city_id' => rand(1,50),
                'user_id' => $userId1,
                'status' => rand(1,3),
                'appointments_day' => rand(4,8),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
