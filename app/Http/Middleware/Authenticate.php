<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware {
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */

    protected $guards = [];

    public function handle ($request, Closure $next, ...$guards) {

        // guardを変数に退避させる。
        $this->guards = $guards;
        return parent::handle ($request, $next, ...$guards);
    }

    protected function redirectTo($request) {

        //Guard名から、それぞれのルートにリダイレクトさせる。

        if (in_array('admin', $this->guards, true)) {
            return route('admin.login');
        }

        elseif (in_array('user', $this->guards, true)) {
            return route('login');
        }
    }
}