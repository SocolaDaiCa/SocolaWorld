<?php

/**
 * @Author: Socola
 * @Email: TokenTien@gmail.com
 * @Date:   2018-02-01 20:03:30
 * @Last Modified by:   Socola
 * @Last Modified time: 2018-05-14 14:07:31
 */
namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies;

    /**
     * The current proxy header mappings.
     *
     * @var array
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
    // protected $headers = [
    //     Request::HEADER_FORWARDED => 'FORWARDED',
    //     Request::HEADER_X_FORWARDED_FOR => 'X_FORWARDED_FOR',
    //     Request::HEADER_X_FORWARDED_HOST => 'X_FORWARDED_HOST',
    //     Request::HEADER_X_FORWARDED_PORT => 'X_FORWARDED_PORT',
    //     Request::HEADER_X_FORWARDED_PROTO => 'X_FORWARDED_PROTO',
    // ];
}
