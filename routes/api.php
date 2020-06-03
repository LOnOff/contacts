<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
//          Ψ_____________________Ψ[ POSTMAN HEADERS  ]Ψ_________________________Ψ
//          |                                                                    |
//          |   °   X-Requested-With       ♦    XMLHttpRequest                   |
//          |   °   Content-Type           ♦    application/json                 |
//          |   °   Accept                 ♦    application/json                 |
//          |   °   Authorization          ♦    {{access_token}}                 |
//          |                                                                    |
//          Ω_____________________Ω[ POSTMAN VARIABLE ]Ω_________________________Ω
//          |                                                                    |
//          |   °    {{home}}              ♦    http://localhost:8000/api/v1     |
//          |   °    {{access_token}}      ♦    Bearer {{token}}                 |
//          |   °    {{token}}             ♦    eyJ0eXAiOiJKV1QiLCJ....          |
//          |   °    {{longitude}}         ♦    -105.0298789                     |
//          |   °    {{latitude}}          ♦    52.95148100000001                |
//          |                                                                    |
//          Δ_____________________Δ[ SERVER COMMANDS  ]Δ_________________________Δ
//          |                                                                    |
//          |            ≡♦♦≡     ~ ♦ Go to artisan ♦ ~    ≡♦♦≡                  |
//          |                                                                    |
//          |         ~     cd /var/www/laravel/                                 |
//          |         ~     git pull                                             |
//          |         ~     composer dumpautoload                                      |
//          |         ~     composer update                                      |
//          |         ~     php artisan storage:link                             |
//          |         ~     php artisan migrate:refresh --seed                   |
//          |         ~     php artisan passport:install                         |
//          |         ~     php artisan passport:client --personal               |
//          |         ~     php artisan passport:client --password               |
//          |                                                                    |
//          |            ≡♦♦≡    ~ ♦ DROP DATABASE ♦ ~    ≡♦♦≡                   |
//          |                                                                    |
//          |         ~     mysql -u user_name -p                                |
//          |   mysql ~     DROP DATABASE db_name;                               |
//          |   mysql ~     exit;                                                |
//          |                                                                    |
//          Ψ____________________________________________________________________Ψ


Route::group(['namespace' => 'api_v1', 'prefix' => 'v1'], function () {

    // Auth
    Route::prefix('auth')
        ->namespace('AuthControllers')
        ->group(function (Router $router) {
            $router->post('signUp',         'AuthController@signUp');
            $router->post('login',          'AuthController@login');
            $router->post('logout',         'AuthController@logout')->middleware('auth:api');
    });

});


