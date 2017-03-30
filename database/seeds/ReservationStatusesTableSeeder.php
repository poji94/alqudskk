<?php

use Illuminate\Database\Seeder;

class ReservationStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservation_statuses')->insert([
            [
                // id = 1
                'name'=>'Pending',
            ],
            [
                // id = 2
                'name'=>'Canceled',
            ],
            [
                // id = 3
                'name'=>'Postponed',
            ],
            [
                // id = 4
                'name'=>'Rejected',
            ],
            [
                // id = 5
                'name'=>'Accepted',
            ],
        ]);
    }
}
