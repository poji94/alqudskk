<?php

use Illuminate\Database\Seeder;

class TypeVacationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_vacations')->insert([
            [
                // id = 1
                'name'=>'Shopping',
            ],
            [
                // id = 2
                'name'=>'Honeymoon',
            ],
            [
                // id = 3
                'name'=>'Cultural',
            ],
            [
                // id = 4
                'name'=>'Nature',
            ],
        ]);
    }
}
