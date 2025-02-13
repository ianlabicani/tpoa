<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Track visitor
        DB::table('visitor_logs')->insert([
            'ip_address' => $request->ip(),
            'visited_at' => now(),
        ]);

        return $next($request);
    }
}
