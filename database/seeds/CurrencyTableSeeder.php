<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('currencies')->truncate();
        \Illuminate\Support\Facades\DB::table('currencies')->insert([
            [
                'symbol' => '$',
                'code' => 'USD',
                'name' => 'United States Dollars'
            ],
            [
                'symbol' => '€',
                'code' => 'EUR',
                'name' => 'Euro'
            ]
        ]);
    }
}
