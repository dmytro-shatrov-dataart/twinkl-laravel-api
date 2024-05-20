<?php

namespace App\Http\Middleware;

use App\Models\BannedIp;
use Closure;
use Illuminate\Http\Request;

class IpGuardMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $bannedIps = BannedIp::all();

        if (in_array($request->ip(), $bannedIps->map->address->toArray())) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
