<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'ckfinder/*',
        "comments",
        "mobile/comments",
        "article/vote",
        "/article/vote",
        "search.html",
        "mobile/search.html",
        "android_webservices_v2/*",
        "/android_webservices_v2/*",
        "admincpanel",
        "admincpanel/*"
    ];
}
