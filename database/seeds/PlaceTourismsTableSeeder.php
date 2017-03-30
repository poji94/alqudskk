<?php

use Illuminate\Database\Seeder;

class PlaceTourismsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('place_tourisms')->insert([
            [
                // id = 1
                'name'=>'Kota Kinabalu',
            ],
            [
                // id = 2
                'name'=>'Kundasang',
            ],
            [
                // id = 3
                'name'=>'Kota Belud',
            ],
            [
                // id = 4
                'name'=>'Tamparuli',
            ],
        ]);
    }
}
