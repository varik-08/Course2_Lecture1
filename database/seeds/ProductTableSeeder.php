<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(['name' => 'Мобильный телефон']);
        Product::create(['name' => 'Ноутбук']);
        Product::create(['name' => 'Умные часы']);
        Product::create(['name' => 'Фитнес браслет']);
        Product::create(['name' => 'Персональный компьютер']);
        Product::create(['name' => 'Наушники']);
        Product::create(['name' => 'Фотокамера']);
    }
}
