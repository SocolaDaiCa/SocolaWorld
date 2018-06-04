<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-03-24 21:08:49
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-05-14 16:06:50
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
        	'User|label label-success',
        	'Admin|label label-warning',
            'Deactive|label label-default'
        ];
        foreach ($permissions as $key => $value) {
            $value = explode('|', $value);
            Permission::create([
                'name' => $value[0],
                'class' => $value[1],
            ]);
        }
    }
}
