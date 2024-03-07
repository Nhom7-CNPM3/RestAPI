<?php

declare(strict_types=1);

namespace venndev\restapi\middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface as Response;

class TestMiddleware
{

    public function __construct()
    {}

    public function __invoke(Request $request, RequestHandler $handler) : Response
    {
        $response = $handler->handle($request);
        $response->getBody()->write('Middleware');
        return $response;
    }

}