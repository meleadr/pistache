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
			'url_img' => '/img/menu/1.webp',
			'published' => 1,
		]);
		\App\Models\Menu::factory()->create([
			'title' => 'Coq au Vin',
			'content' => 'Poulet, vin rouge, champignons...',
			'url_img' => '/img/menu/2.jpg',
			'published' => 1,
		]);
		\App\Models\Menu::factory()->create([
			'title' => 'Moules Marinières',
			'content' => 'Moules, vin blanc, oignons...',
			'url_img' => '/img/menu/3.jpg',
			'published' => 1,
		]);
		\App\Models\Menu::factory()->create([
			'title' => 'Tarte aux pommes',
			'content' => 'Pommes, pâte, sucre...',
			'url_img' => '/img/menu/4.jpg',
			'published' => 1,
		]);
		\App\Models\Menu::factory()->create([
			'title' => 'Sole au sel',
			'content' => 'Sole, sel, citron...',
			'url_img' => '/img/menu/5.jpg',
			'published' => 1,
		]);
		\App\Models\Menu::factory()->create([
			'title' => 'Salade de la mer',
			'content' => 'Salade, tomates, olives, œuf, crevettes, saumon...',
			'url_img' => '/img/menu/6.jpg',
			'published' => 1,
		]);
    }
}
