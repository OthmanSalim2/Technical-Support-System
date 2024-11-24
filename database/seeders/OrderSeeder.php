<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Order::create([
//            'name' => $this->faker->name(),
//            'status' => Str::random(['pending', 'completed', 'cancelled']),
//        ]);
        Order::factory()->count(5)->create();
    }
}
