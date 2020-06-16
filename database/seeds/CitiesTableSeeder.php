<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = new \App\City();
        $city->name = 'Ha Noi';
        $city->save();

        $city = new \App\City();
        $city->name = 'Ha Nam';
        $city->save();

        $city = new \App\City();
        $city->name = 'Ho Chi Minh';
        $city->save();
    }
}
