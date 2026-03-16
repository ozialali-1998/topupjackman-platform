<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@kako.live',
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('password123'),
            'is_admin' => true,
        ]);

        foreach ([
            [60, 13000],
            [150, 30000],
            [300, 58000],
            [700, 128000],
            [1500, 268000],
            [2000, 350000],
        ] as [$coin, $price]) {
            Product::updateOrCreate(['coins' => $coin], [
                'name' => "{$coin} Coins",
                'price' => $price,
                'is_active' => true,
            ]);
        }
    }
}
