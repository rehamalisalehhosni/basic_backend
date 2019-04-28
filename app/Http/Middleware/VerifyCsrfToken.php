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
     /**
      * The URIs that should be excluded from CSRF verification.
      *
      * @var array
      */
     protected $except = [
         //
         'adminControl/uploadImage/*',
         'adminControl/projects/deleteProjectsImages',
         'adminControl/projects/deleteProjectsPlans',
         'en/subscribe/add',
         'ar/subscribe/add',

     ];
}
