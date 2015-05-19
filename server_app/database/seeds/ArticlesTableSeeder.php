<?php

use Illuminate\Database\Seeder;
use App\Article;

use Faker\Factory as Faker;
use Carbon\Carbon;

class ArticlesTableSeeder extends Seeder {

	public function run() {
		DB::table('articles')->delete();

		$faker = Faker::create();

		for ($i = 0; $i < 10; $i++) {
			Article::create([
				'title' => $faker->sentence(),
				'body' => $faker->paragraph(),
				'published_at' => Carbon::now(),
				]);
		}
	}
}