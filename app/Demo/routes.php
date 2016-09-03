<?php
// Routes

use App\Demo\Front\Controller\PaginationController;
use App\Demo\Front\Controller\SampleController;
use Slim\App;
use Tuum\Builder\AppBuilder;
use Tuum\Respond\Respond;

return function(AppBuilder $builder) {

    /**
     * @var App $app
     */
    $app = $builder->app;

    $app->any('/', function ($request, $response, $args) {
        // Render index view
        return Respond::view($request, $response)->render('index', $args);
    });
    
    $app->any('/control', SampleController::class);
    $app->any('/pagination', PaginationController::class)->add('paginate');

    $app->get('/throw', function () {
        // Render index view
        throw new RuntimeException('always throws an exception!');
    });
    
    $app->get('/name/[{name}]', function ($request, $response, $args) {
        // Render index view
        if (!isset($args['name'])) {
            $args['name'] = 'Slim+Tuum';
        }
        return Respond::view($request, $response)->render('index', $args);
    });
};
