<?php
// Routes

use App\Front\Controller\SampleController;
use Slim\App;
use Tuum\Builder\AppBuilder;
use Tuum\Respond\Respond;

return function(AppBuilder $builder) {

    /**
     * @var App $app
     */
    $app = $builder->app;

    $app->any('/control', SampleController::class);

    $app->get('/throw', function ($request, $response, $args) {
        // Render index view
        throw new RuntimeException('always throws an exception!');
    });
    
    $app->get('/[{name}]', function ($request, $response, $args) {
        // Render index view
        return Respond::view($request, $response)->render('index', $args);
    });
};
