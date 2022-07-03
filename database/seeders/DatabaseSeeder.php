<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\InvoiceFactory;
use Database\Factories\InvoiceItemFactory;
use Database\Factories\ItemFactory;
use Database\Factories\SupplierFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/* Extending the Seeder class. */

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@admin',
            'password' => bcrypt('admin'),
        ]);
        User::create([
            'username' => 'user',
            'email' => 'user@user',
            'password' => bcrypt('user'),
        ]);
        User::factory(13)->create();



        SupplierFactory::new()->count(44)->create();
        $this->call(SupplierSeeder::class);

        InvoiceFactory::new()->count(800)->create();
        $this->call(ItemSeeder::class);



        InvoiceItemFactory::new()->count(4000)->create();


        // create admin user
    }
}
