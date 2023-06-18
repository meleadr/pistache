<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuHasCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		\App\Models\MenuHasCategory::factory()->create([
			'menu_id' => 1,
			'category_id' => 1,
		]);
		\App\Models\MenuHasCategory::factory()->create([
			'menu_id' => 1,
			'category_id' => 2,
		]);
		\App\Models\MenuHasCategory::factory()->create([
			'menu_id' => 2,
			'category_id' => 3,
		]);
		\App\Models\MenuHasCategory::factory()->create([
			'menu_id' => 3,
			'category_id' => 6,
		]);
		\App\Models\MenuHasCategory::factory()->create([
			'menu_id' => 4,
			'category_id' => 5,
		]);
		\App\Models\MenuHasCategory::factory()->create([
			'menu_id' => 5,
			'category_id' => 4,
		]);
		\App\Models\MenuHasCategory::factory()->create([
			'menu_id' => 6,
			'category_id' => 1,
		]);
		\App\Models\MenuHasCategory::factory()->create([
			'menu_id' => 6,
			'category_id' => 2,
		]);
		\App\Models\MenuHasCategory::factory()->create([
			'menu_id' => 6,
			'category_id' => 6,
		]);
    }
}
