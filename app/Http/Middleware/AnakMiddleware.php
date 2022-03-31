<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\Anak;

class AnakMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $check = Anak::where('id_user', Auth::user()->id_user)->first();

        if(empty($check)){
            return response()->json([
                'status' => false,
                'message' => 'Isi Data Anak Terlebih Dahulu'
            ], 201);
        } else {
            return $next($request);
        }
    }
}
