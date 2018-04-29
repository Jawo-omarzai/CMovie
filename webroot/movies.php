<?php

require __DIR__.'/config_with_app.php';
 
$di = new \Anax\DI\CDIFactoryDefault();
$di->set('form', '\Mos\HTMLForm\CForm');

$di->set('MoviesController', function() use ($di){

    $controller = new \Anax\Movies\MoviesController();
    $controller->setDI($di);
    return $controller;

});


$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
    $db->connect();
    return $db;
});

$app = new \Anax\MVC\CApplicationBasic($di);


$app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');

$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_movies.php');
$app->url->setUrlType(\Anax\Url\CUrl::URL_APPEND);

$app->router->add('', function() use ($app){

    $app->theme->setTitle("Testing cform with anax");
    $app->views->add('default/page',[
        'title' => '<h1 class="text-center text.align-baseline alert-heading h1 text-justify text-capitalize"> Welcome to Anax Movies</h1>',
        'content' => '.',
        
    ]);
});

$app->router->add('setup', function() use ($app){

    $app->theme->setTitle("Testing cform with anax");
    $app->views->add('default/page',[
        'title' => '<h1 class="text-center text.align-baseline alert-heading h1 text-justify text-capitalize"> Welcome to Anax Movies</h1>',
        'content' => '.',
        
    ]);
});




$app->router->handle();
$app->theme->render();