<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->truncate();

		$admin = new \App\Src\User\User();
		$admin->email = "admin@admin.com";
		$admin->password = Hash::make("admin");
		$admin->save();

		$admin = new \App\Src\User\User();
		$admin->email = "user1@admin.com";
		$admin->password = Hash::make("admin");
		$admin->save();

		$admin = new \App\Src\User\User();
		$admin->email = "user2@admin.com";
		$admin->password = Hash::make("admin");
		$admin->save();
	}

}