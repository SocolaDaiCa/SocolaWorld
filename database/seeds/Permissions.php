<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-03-24 21:08:49
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-24 21:10:42
 */
use App\Models\Permission;
use Illuminate\Database\Seeder;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
        	'User',
        	'Admin'
        ];
        foreach ($permissions as $key => $value) {
        	$permission = new Permission;
        	$permission->name = $value;
        	$permission->save();
        }
    }
}
