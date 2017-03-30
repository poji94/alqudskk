<?php

use Illuminate\Database\Seeder;

class PackageToursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('package_tours')->insert([
            [
                'name'=>'Kota Kinabalu Tour',
                'description'=>
                    'The The collection of the itineraries around Kota Kinabalu',
                'duration'=>'3d',
                'price_children'=>150,
                'price_adult'=>200,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'Nature Tour Sabah',
                'description'=>
                    'Relax and chill while enjoying the view of nature in Sabah',
                'duration'=>'3d',
                'price_children'=>125,
                'price_adult'=>175,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
