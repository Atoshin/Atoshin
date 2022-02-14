<?php

namespace App\Http\Middleware;

use App\Models\Signature;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorizeMetamask
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        if ($token) {
            $token = Signature::query()->where('hash', $token)->first();
            if ($token) {
                return $next($request);
            }
        }
        return response()->json([
            'message' => 'unauthorized'
        ], 401);
    }
}
