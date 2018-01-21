<?php

use Illuminate\Database\Seeder;

class Categorys extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		$data = [
			['Ứng Dụng', 'apps'],
			['get Link', 'get-link'],
			['Quản Lý Nhóm', 'group'],
			['Quản Lý Trang Cá Nhân', 'profile'],
		];
		foreach ($data as $value) {
			DB::table('categorys')->insert([
			'name' => $value[0],
			'tag' => $value[1],
		]);
		}
	}
}
