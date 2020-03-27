<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(CurrencyTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
