<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_name = storage_path('../').'ecu.json';
        $ecuJson = file_get_contents($file_name);
        $ecuArray = json_decode($ecuJson, true);
        extract($ecuArray);
        $coutryId = DB::table('countries')->insertGetId([
            'name'=>$name,
            'slug'=>$iso3,
            'currency'=>$currency,
            'latitude'=>$latitude, 
            'longitude'=>$longitude 
        ]);       
        foreach ($states as $state) {
            $stateId = DB::table('states')->insertGetId([
                'name'=>$state['name'],
                'slug'=>$state['state_code'],
                'latitude'=>$state['latitude'], 
                'longitude'=>$state['longitude'],
                'country_id'=>$coutryId 
            ]);
            foreach ($state['cities'] as $city) {
                DB::table('cities')->insertGetId([
                    'name'=>$city['name'],
                    'slug'=>"$iso3-".$state['state_code']."-".strtoupper($city['name']),
                    'latitude'=>$city['latitude'], 
                    'longitude'=>$city['longitude'],
                    'region_id'=>$stateId,
                    'country_id'=>$coutryId,
                ]);
            }
        }
    }
}
