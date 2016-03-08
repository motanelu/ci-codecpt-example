<?php

use Symfony\Component\HttpFoundation\Request;

/**
 * Handle the entry point route
 */
$app->get('/', function(Request $request) use ($app) {
    return $app['twig']->render('index.twig');
});

/**
 * Handle HTTP GET to /login
 */
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login-form.twig');
});

/**
 * Handle HTTP POST to /login
 */
$app->post('/login', function(Request $request) use ($app) {
    $loggedIn = false;

    // NSA proof algorythm
    if ($request->request->get('name') == 'Tudor' && $request->request->get('password') == '1234') {
        $loggedIn = true;
    }

    return $app['twig']->render('login-result.twig', ['loggedIn' => $loggedIn]);
});

$app->get('/items/new', function(Request $request) use ($app) {
    return $app['twig']->render('items/form.twig');
});

$app->post('/items/new', function(Request $request) use ($app) {
    $item = new \PhpBcn\Entity\Item();
    $item->setName($request->request->get('name'));
    $app['em']->transactional(function($em) use ($item) {
        $em->persist($item);
    });

    return $app->redirect('/items');
});

$app->get('/items/', function(Request $request) use ($app) {
    $items = $app['em']->getRepository('\\PhpBcn\\Entity\\Item')->findAll();
    return $app['twig']->render('items/index.twig', ['items' => $items]);
});
