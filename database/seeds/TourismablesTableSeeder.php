<?php

use Illuminate\Database\Seeder;

class TourismablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tourismables')->insert([
            [
                // itinerary id = 1
                'place_tourism_id'=>1,
                'tourismable_id'=>1,
                'tourismable_type'=>'App\Itinerary',
            ],
            [
                // itinerary id = 2
                'place_tourism_id'=>3,
                'tourismable_id'=>2,
                'tourismable_type'=>'App\Itinerary',
            ],
            [
                // itinerary id = 3
                'place_tourism_id'=>4,
                'tourismable_id'=>3,
                'tourismable_type'=>'App\Itinerary',
            ],
            [
                // itinerary id = 4
                'place_tourism_id'=>2,
                'tourismable_id'=>4,
                'tourismable_type'=>'App\Itinerary',
            ],
            [
                // itinerary id = 5
                'place_tourism_id'=>1,
                'tourismable_id'=>5,
                'tourismable_type'=>'App\Itinerary',
            ],
            [
                // package_tour id = 1  <- from itinerary 1
                'place_tourism_id'=>1,
                'tourismable_id'=>1,
                'tourismable_type'=>'App\PackageTour',
            ],
            [
                // package_tour id = 1  <- from itinerary 2
                'place_tourism_id'=>1,
                'tourismable_id'=>1,
                'tourismable_type'=>'App\PackageTour',
            ],
            [
                // package_tour id = 2  <- from itinerary 1
                'place_tourism_id'=>2,
                'tourismable_id'=>2,
                'tourismable_type'=>'App\PackageTour',
            ],
            [
                // package_tour id = 2  <- from itinerary 1
                'place_tourism_id'=>1,
                'tourismable_id'=>2,
                'tourismable_type'=>'App\PackageTour',
            ],

        ]);
    }
}
