<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		\App\Models\Menu::factory()->create([
			'title' => 'Salade Niçoise',
			'content' => 'Salade, tomates, olives, œuf...',
		]);
		\App\Models\Menu::factory()->create([
			'title' => 'Coq au Vin',
			'content' => 'Poulet, vin rouge, champignons...',
		]);
		\App\Models\Menu::factory()->create([
			'title' => 'Moules Marinières',
			'content' => 'Moules, vin blanc, oignons...',
		]);
		\App\Models\Menu::factory()->create([
			'title' => 'Tarte aux pommes',
			'content' => 'Pommes, pâte, sucre...',
		]);
		\App\Models\Menu::factory()->create([
			'title' => 'Sol au sel',
			'content' => 'Sole, sel, citron...',
		]);
		\App\Models\Menu::factory()->create([
			'title' => 'Salade de la mer',
			'content' => 'Salade, tomates, olives, œuf, crevettes, saumon...',
		]);
    }
}
