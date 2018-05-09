<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-04-22 06:38:47
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-04-22 09:09:32
 */
namespace App\MyClass;

use Ixudra\Curl\Facades\Curl;

class Imgur
{
	public static function upload($image)
	{
		$imagebase64 = base64_encode(file_get_contents($image->path()));
		$res = Curl::to('https://api.imgur.com/3/upload')
			->withData([
				'image' => $imagebase64
			])->withHeader('Authorization: Client-ID 4646e0a551dca03')
			->asJson()->post();
		return $res->data->link;
	}
}