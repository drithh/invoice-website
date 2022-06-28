<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/* It reads the contents of the `supplier.sql` file and runs it against the database */

class SupplierSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // sql file get contens
        $sql = file_get_contents(__DIR__ . '/../sql/supplier.sql');
        DB::unprepared($sql);
    }
}
