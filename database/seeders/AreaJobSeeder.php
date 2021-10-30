<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert(['name'=>'Odontología']);
        DB::table('areas')->insert(['name'=>'Odontología 2']);
        DB::table('areas')->insert(['name'=>'Odontología 3']);
        DB::table('areas')->insert(['name'=>'Odontología 4']);
        DB::table('areas')->insert(['name'=>'Odontología 5']);
        DB::table('classificators')->insert(['name'=>'Dr.','type'=>'worker','created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),]);
        DB::table('classificators')->insert(['name'=>'Dra.','type'=>'worker','created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),]);
        DB::table('classificators')->insert(['name'=>'MsC.','type'=>'worker','created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),]);
        DB::table('classificators')->insert(['name'=>'um','type'=>'product','created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),]);
        DB::table('classificators')->insert(['name'=>'caja','type'=>'product','created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),]);
        DB::table('classificators')->insert(['name'=>'lts','type'=>'product','created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),]);
    }
}
