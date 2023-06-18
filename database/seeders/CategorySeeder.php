<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		\App\Models\Category::factory()->create([
			'name' => 'Salades',
		]);
		\App\Models\Category::factory()->create([
			'name' => 'Végétarien',
		]);
		\App\Models\Category::factory()->create([
			'name' => 'Viandes',
		]);
		\App\Models\Category::factory()->create([
			'name' => 'Poissons',
		]);
		\App\Models\Category::factory()->create([
			'name' => 'Desserts',
		]);
		\App\Models\Category::factory()->create([
			'name' => 'Fruits de mer',
		]);
    }
}
