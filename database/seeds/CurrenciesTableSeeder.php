<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            [
                'id'=>1,
                'name'=>'Malaysian Ringgit',
                'code'=>'MYR',
                'symbol'=>'RM',
                'format'=>'RM1,0.00',
                'exchange_rate'=>'1',
                'active'=>0,
            ],
            [
                'id'=>2,
                'name'=>'Singapore Dollar',
                'code'=>'SGD',
                'symbol'=>'$',
                'format'=>'$1,0.00',
                'exchange_rate'=>'0.3222',
                'active'=>0,
            ],
            [
                'id'=>3,
                'name'=>'US Dollar',
                'code'=>'USD',
                'symbol'=>'$',
                'format'=>'$1,0.00',
                'exchange_rate'=>'0.231',
                'active'=>0,
            ],
            [
                'id'=>4,
                'name'=>'Thailand Baht',
                'code'=>'THB',
                'symbol'=>'฿',
                'format'=>'฿1,0.00',
                'exchange_rate'=>'7.977',
                'active'=>0,
            ],
            [
                'id'=>5,
                'name'=>'Australian Dollar',
                'code'=>'AUD',
                'symbol'=>'$',
                'format'=>'$1,0.00',
                'exchange_rate'=>'0.3112',
                'active'=>0,
            ],
            [
                'id'=>6,
                'name'=>'Russian Ruble',
                'code'=>'RUB',
                'symbol'=>'₽',
                'format'=>'1 0,00 ₽',
                'exchange_rate'=>'13.098',
                'active'=>0,
            ],
        ]);
    }
}
