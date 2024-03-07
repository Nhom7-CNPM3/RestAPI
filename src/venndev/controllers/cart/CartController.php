<?php

declare(strict_types=1);

namespace venndev\restapi\controllers\cart;

use Throwable;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use venndev\restapi\middlewares\TestMiddleware;
use venndev\restapi\provider\database\ResultQuery;
use venndev\restapi\provider\Provider;
use venndev\restapi\utils\attributes\RequestMapping;
use venndev\restapi\utils\HttpMethod;

// Url có dạng: http://localhost:8080/cart
#[RequestMapping(["value" => "cart"])]
final class CartController
{

    // Url có dạng: http://localhost:8080/cart/getDataByCartId/
    /**
     * @throws Throwable
     */
    #[RequestMapping([
        "value" => "/getDataByCartId/{cartId}",
        "method" => HttpMethod::GET,
        "produces" => ["application/json"]
    ])]
    public function getDataByCartId(Request $request, Response $response, array $args, array $queryParams) : Response
    {
        // Kiểm tra xem cartId có được truyền vào không nếu không thì trả về lỗi với status code 400
        if (!isset($args["cartId"])) {
            $response->getBody()->write(json_encode([
                "status" => "error",
                "message" => "CartId cần được truyền vào!"
            ]));
            return $response->withStatus(400);
        }

        $cartId = $args["cartId"];
        $data = [
            "id" => $cartId,
            "name" => "TrungBip"
        ];

        Provider::getMySQL()->execute("SELECT * FROM `cart` WHERE `CartId` = :id AND `TrungBip` = :name", $data)
            ->then(function(ResultQuery $result) use ($response) {

            $result = [
                "status" => $result->getStatus(),
                "result" => $result->getResult()
            ];

            $response->getBody()->write(json_encode($result));
        });

        return $response->withStatus(200);
    }

}