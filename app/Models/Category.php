<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:29
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-03-25 13:08:42
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categorys";

    public function apps()
    {
    	return $this->hasMany('App\Models\App');
    }
}
