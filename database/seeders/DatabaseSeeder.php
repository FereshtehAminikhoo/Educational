<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public static $seeders = [];


    public function run()
    {
        foreach(self::$seeders as $seeder){
            $this->call($seeder);
        }

        // \App\Models\User::factory(10)->create();
    }
}
