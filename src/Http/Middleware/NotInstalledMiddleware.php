<?php

namespace GamingEngine\Installation\Http\Middleware;

use Closure;
use GamingEngine\Core\Framework\Installation\CoreInstallationVerification;
use Illuminate\Http\Request;

class NotInstalledMiddleware
{
    public function __construct(private CoreInstallationVerification $verification)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->verification->installed()) {
            return redirect('/');
        }

        return $next($request);
    }
}
