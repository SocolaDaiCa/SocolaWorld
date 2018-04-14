<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-03-24 21:04:22
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-24 21:25:05
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    public function users()
    {
    	return $this->hasMany('App\User');
    }
}
