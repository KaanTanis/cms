<?php

namespace App\Http\Middleware;

use App\Helpers\Helper;
use Closure;
use Illuminate\Http\Request;

class Sidebar
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
        $classes = [];

        $ankaPath = '\App\Anka';
        foreach (glob(app_path('/Anka/*.php')) as $item) {
            $ankaClass = basename($item, '.php');
            $path = $ankaPath . '\\' . $ankaClass;

            if (!$path::$hideFromSidebar && $path::$customController == false) {
                $classes[] = [
                    'name' => $path::$nameIndex,
                    'url' => $path::$slug,
                    'icon' => $path::$icon
                ];
            } else {
                if (!$path::$hideFromSidebar) {
                    $classes[] = [
                        'name' => $path::$nameIndex,
                        'url' => $path::$slug,
                        'icon' => $path::$icon,
                        'custom_url' => true
                    ];
                }

            }
        }



        $request->merge(['sidebar' => $classes]);

        return $next($request);
    }
}
