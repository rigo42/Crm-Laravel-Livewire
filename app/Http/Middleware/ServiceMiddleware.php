<?php

namespace App\Http\Middleware;

use App\Models\Service;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $client = Service::find($request->service->id)->client()->first();
        $userPresent = User::find(Auth::user()->id);
        if($client->user_id === $userPresent->id || $userPresent->hasRole('Administrador')){
            return $next($request);
        }else{
            session()->flash('alert','No tienes los permisos suficientes');
            session()->flash('alert-type', 'warning');
            return redirect()->route('service.index');
        }
    }
}
