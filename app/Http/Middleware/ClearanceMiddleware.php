<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {        
        if (Auth::user()->hasPermissionTo('Administer roles & permissions')) {
            return $next($request);
        }

        if ($request->is('profiles/create')) {
            if (!Auth::user()->hasPermissionTo('Create Profiles')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
            
        if ($request->is('profiles/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Edit Profiles')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) {
            if (!Auth::user()->hasPermissionTo('Delete Profiles')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        if ($request->is('courses/create')) {
            if (!Auth::user()->hasPermissionTo('Create Course')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        if ($request->is('courses/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Edit Course')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        
        
        if ($request->is('lessons/create')) {
            if (!Auth::user()->hasPermissionTo('Create Lessons')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
            
        if ($request->is('lessons/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Edit Lessons')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
         if ($request->isMethod('Delete')) {
            if (!Auth::user()->hasPermissionTo('Delete Lessons')) {
                abort('401');
            } else {
                return $next($request);
            }
         }
       


        return $next($request);
    }
}