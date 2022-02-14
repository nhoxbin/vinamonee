<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \URL::forceScheme('http');

        Response::macro('success', function ($data) {
            return response()->json([
                'success' => true,
                'type' => 'success',
                'data' => $data,
            ]);
        });

        Response::macro('error', function ($msg, $code = 200) {
            return response()->json([
                'success' => false,
                'type' => 'error',
                'message' => $msg,
            ], $code);
        });
    }
}
