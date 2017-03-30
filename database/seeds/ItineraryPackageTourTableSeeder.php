<?php

use Illuminate\Database\Seeder;

class ItineraryPackageTourTableSeeder extends Seeder
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
                // packagetour id =1 , first itinerary
                'package_tour_id'=>1,
                'itinerary_id'=>5,
            ],
            [
                // packagetour id =1 , second itinerary
                'package_tour_id'=>1,
                'itinerary_id'=>1,
            ],
            [
                // packagetour id =1 , first itinerary
                'package_tour_id'=>2,
                'itinerary_id'=>4,
            ],
            [
                // packagetour id =1 , second itinerary
                'package_tour_id'=>2,
                'itinerary_id'=>2,
            ],
            [
                // packagetour id =1 , third itinerary
                'package_tour_id'=>2,
                'itinerary_id'=>5,
            ],
        ]);
    }
}
