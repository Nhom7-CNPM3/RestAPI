<?php

declare(strict_types=1);

namespace venndev\restapi\controllers;

use Throwable;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use venndev\restapi\middlewares\TestMiddleware;
use venndev\restapi\provider\database\ResultQuery;
use venndev\restapi\provider\Provider;
use venndev\restapi\utils\attributes\RequestMapping;
use venndev\restapi\utils\HttpMethod;

// Url có dạng: http://localhost:8080/
#[RequestMapping(["value" => ""])]
final class HelloNam
{

    // Url có dạng: http://localhost:8080/nam/create?name=NguyenVanNam&age=20
    /**
     * @throws Throwable
     */
    #[RequestMapping([
        "value" => "/create",
        "queryParams" => ["name", "age"],
        "method" => HttpMethod::GET,
        "produces" => ["application/json"],
        "middleware" => new TestMiddleware()
    ])]
    public function hello(Request $request, Response $response, array $args, array $queryParams) : Response
    {
        var_dump($queryParams);
//        Provider::getMySQL()->execute("SELECT * FROM author")->then(function(ResultQuery $result) use ($response) {
//            $result = [
//                "status" => $result->getStatus(),
//                "result" => $result->getResult()
//            ];
//
//            $response->getBody()->write(json_encode($result));
//        });

        return $response->withStatus(200);
    }

}