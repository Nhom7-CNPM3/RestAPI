<?php

declare(strict_types=1);

namespace venndev\restapi\controllers\author;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Throwable;
use venndev\restapi\provider\database\ResultQuery;
use venndev\restapi\provider\Provider;
use venndev\restapi\utils\attributes\RequestMapping;
use venndev\restapi\utils\HttpMethod;

#[RequestMapping(["value" => "/author"])]
final class AuthorController
{

    /**
     * @throws Throwable
     */
    #[RequestMapping([
        "value" => "/getNameAuthor/{id}",
        "method" => HttpMethod::GET,
        "produces" => ["application/json"]
    ])]
    public function getNameAuthorById(Request $request, Response $response, array $args, array $queryParams) : Response
    {
        if (!isset($args["id"])) {
            $response->getBody()->write(json_encode(["message" => "Id is required"]));
            return $response->withStatus(400);
        }

        $id = $args["id"];

        if (!is_numeric($id)) {
            $response->getBody()->write(json_encode(["message" => "Id must be a number"]));
            return $response->withStatus(400);
        }

        Provider::getMySQL()->execute("SELECT `AuthorName` FROM author WHERE `AuthorId` = :id", ["id" => $id])
            ->then(function(ResultQuery $result) use ($response, $id) {
            $result = [
                "status" => $result->getStatus(),
                "result" => $result->getResult()
            ];

            $response->getBody()->write(json_encode($result));
        });

        return $response;
    }

}