<?php

declare(strict_types=1);

namespace venndev\restapi\controllers\hello;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use venndev\restapi\utils\attributes\RequestMapping;
use venndev\restapi\utils\HttpMethod;

// Url có dạng: http://localhost:8080/hello
#[RequestMapping(["value" => "/hello"])]
final class HelloWorld
{

    // Url có dạng: http://localhost:8080/hello/world
    #[RequestMapping([
        "value" => "/world",
        "method" => HttpMethod::GET,
        "produces" => ["application/json"]
    ])]
    public function hello(Request $request, Response $response, array $args, array $queryParams) : Response
    {
        $response->getBody()->write('Hello world!');
        return $response;
    }

}