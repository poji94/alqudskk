<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->insert([
            [
                // id = 1
                'name'=>'Administrator',
            ],
            [
                // id = 2
                'name'=>'Executive Staff',
            ],
            [
                // id = 3
                'name'=>'Tourist',
            ],
        ]);
    }
}
