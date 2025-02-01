<?php
// app/Http/Middleware/LogUserActivity.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LogUserActivity
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        if (Auth::check()) {
            $log = [
                'user_id' => Auth::id(),
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'created_at' => now()
            ];
            
            Log::channel('user-activity')->info('User Activity', $log);
        }
        
        return $response;
    }
}