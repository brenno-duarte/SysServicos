<?php

$config = [
    'settings' => [
        'addContentLengthHeader' => false,
        'displayErrorDetails' => true
    ]
];
$app = new \Slim\App($config);

$container = $app->getContainer();

$container['view'] = function ($container) {
   $view = new \Slim\Views\Twig(__DIR__ . '/view/templates', [
       'cache' => false,
   ]);
   
   // Instantiate and add Slim specific extension
   $router = $container->get('router');
   $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
   $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

   return $view;
};

// Register provider
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};