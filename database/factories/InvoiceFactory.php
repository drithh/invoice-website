<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $penjualan = rand(1, 5);
        return [
            'user_id' => $this->faker->numberBetween(1, 15),
            'invoice_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'category' => $penjualan < 5 ? 'penjualan' : 'pembelian',
            'supplier_id' => $penjualan < 5 ? null : $this->faker->numberBetween(1, 44),

        ];
    }
}
