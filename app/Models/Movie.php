<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-04-21 12:22:31
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-22 09:25:09
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    protected $guarded = ['id'];
}
