<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:31
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-27 15:30:02
 */
use App\Models\Category;
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
			$category = new Category;
			$category->name = $value[0];
			$category->slug = $value[1];
			$category->save();
		}
	}
}
