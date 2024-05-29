<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ValidateSignature as BaseValidateSignature;
use Illuminate\Support\Facades\Auth;

class ValidateSignature extends BaseValidateSignature
{
    /**
     * The names of the query string parameters that should be ignored.
     *
     * @var array
     */
    protected $except = [
        // 'fbclid',
        // 'utm_campaign',
        // 'utm_content',
        // 'utm_medium',
        // 'utm_source',
        // 'utm_term',
    ];
}
