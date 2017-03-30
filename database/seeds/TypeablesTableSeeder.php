<?php

use Illuminate\Database\Seeder;

class TypeablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('typeables')->insert([
            [
                // id = 1
                'type_vacation_id'=>3,
                'typeable_id' =>1,
                'typeable_type' =>'App\Itinerary',
            ],
            [
                // id = 2
                'type_vacation_id'=>4,
                'typeable_id' =>2,
                'typeable_type' =>'App\Itinerary',
            ],
            [
                // id = 3
                'type_vacation_id'=>5,
                'typeable_id' =>3,
                'typeable_type' =>'App\Itinerary',
            ],
            [
                // id = 4
                'type_vacation_id'=>4,
                'typeable_id' =>4,
                'typeable_type' =>'App\Itinerary',
            ],
            [
                // id = 5
                'type_vacation_id'=>4,
                'typeable_id' =>5,
                'typeable_type' =>'App\Itinerary',
            ],
        ]);
    }
}
