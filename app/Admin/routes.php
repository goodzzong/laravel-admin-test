<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resources([
        'intro/articles'              => ArticleController::class,
        'medias'                      => MediaController::class,
        'event/articles'              => EventController::class,
        'notices'                     => NoticeController::class,
        'news'                        => NewsController::class,
    ]);

    $router->resource('intro/config', 'introMenuController', ['except' => ['create']]);
    $router->resource('event/config', 'eventMenuController', ['except' => ['create']]);
    //$router->get('intro/config', 'introMenuController@index')->name('config.index');
    //$router->post('intro/config', 'introMenuController@store')->name('config.store');
    //$router->post('intro/articles', 'ArticleController@display')->name('articles.display');
});
