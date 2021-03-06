<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'=>'Ahmad Fauzi',
                'email'=>'ahmadfauziyhy@gmail.com',
                'password'=>bcrypt('poji94'),
                'role_user_id'=>1,
                'phone_number'=>'01412345678',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'Lisaa',
                'email'=>'lisa@gmail.com',
                'password'=>bcrypt('secret'),
                'role_user_id'=>2,
                'phone_number'=>'',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'Adrian',
                'email'=>'adrian@gmail.com',
                'password'=>bcrypt('secret'),
                'role_user_id'=>3,
                'phone_number'=>'',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
