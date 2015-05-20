<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();

		User::create([
			'name' => 'root',
			'email' => 'root@sample.com',
			'password' => bcrypt('password')
			]);
	}
}