<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/* Extending the Seeder class. */

class ItemSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // sql file get contens
        $sql = file_get_contents(__DIR__ . '/../sql/items.sql');
        DB::unprepared($sql);
    }
}
