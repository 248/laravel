<?php

use Illuminate\Database\Seeder;
use App\Article;
use App\User;

use Faker\Factory as Faker;
// use Carbon\Carbon;

class ArticlesTableSeeder extends Seeder {

	public function run() {
		DB::table('articles')->delete();

		$user = User::all()->first();
		$faker = Faker::create();

		for ($i = 0; $i < 10; $i++) {
			// Article::create([
			// 	'title' => $faker->sentence(),
			// 	'body' => $faker->paragraph(),
			// 	'published_at' => Carbon::now(),
			// 	]);
			
			$article = new Article([
				'title' => $faker->sentence(),
				'body' => $faker->paragraph(),
				'published_at' => Carbon\Carbon::now(),
				]);
            $user->articles()->save($article);  // $userと関連付けて $articleを保存
        }
    }
}