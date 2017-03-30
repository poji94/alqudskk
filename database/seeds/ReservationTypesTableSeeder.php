<?php

use Illuminate\Database\Seeder;

class ReservationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservation_types')->insert([
            [
                // id = 1
                'name'=>'Ground',
            ],
            [
                // id = 2
                'name'=>'Full Boats',
            ],
        ]);
    }
}
