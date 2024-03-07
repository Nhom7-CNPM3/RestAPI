<?php

declare(strict_types=1);

namespace venndev\restapi\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use venndev\restapi\middlewares\TestMiddleware;
use venndev\restapi\utils\attributes\RequestMapping;
use venndev\restapi\utils\HttpMethod;

// Url có dạng: http://localhost:8080/
#[RequestMapping(["value" => ""])]
final class HelloJson
{

    // Url có dạng: http://localhost:8080/hellojs
    #[RequestMapping([
        "value" => "/hellojs",
        "method" => HttpMethod::GET,
        "produces" => ["application/json"]
    ])]
    public function hello(Request $request, Response $response, array $args, array $queryParams) : Response
    {
        $response->getBody()->write(json_encode(["message" => "Hello world!"]));
        return $response;
    }

}