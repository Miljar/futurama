<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/ServiceConfiguration.php';

use bitExpert\Disco\AnnotationBeanFactory;
use bitExpert\Disco\BeanFactoryRegistry;
use Amp\Http\Server\RequestHandler\CallableRequestHandler;
use Amp\Http\Server\Router;
use Amp\Http\Server\Server;
use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Http\Status;
use Amp\Socket;
use Fry\Controller\Relay;
use Psr\Log\NullLogger;

$parameters = [
    'relay' => [
        'IN1' => 17,
        'IN2' => 18,
        'IN3' => 27,
        'IN4' => 22,
        'IN5' => 23,
        'IN6' => 24,
        'IN7' => 25,
        'IN8' => 3,
    ]
];
$beanFactory = new AnnotationBeanFactory(ServiceConfiguration::class, $parameters);
BeanFactoryRegistry::register($beanFactory);

Amp\Loop::run(function () use ($beanFactory) {
    $sockets = [
        Socket\listen("0.0.0.0:8085"),
        Socket\listen("[::]:8085"),
    ];

    $router = new Router;

    $router->addRoute('GET', '/relay/{number:[1-8]}/command/pulse', new CallableRequestHandler($beanFactory->get(Relay::class)));

    $server = new Server($sockets, $router, new NullLogger);

    yield $server->start();

    // Stop the server gracefully when SIGINT is received.
    // This is technically optional, but it is best to call Server::stop().
    Amp\Loop::onSignal(SIGINT, function (string $watcherId) use ($server) {
        Amp\Loop::cancel($watcherId);
        yield $server->stop();
    });
});
