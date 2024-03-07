<?php

declare(strict_types=1);

namespace venndev\restapi\app;

use ReflectionClass;
use ReflectionException;
use Slim\Routing\RouteContext;
use Throwable;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use venndev\restapi\utils\attributes\RequestMapping;
use venndev\restapi\utils\FileManager;
use venndev\restapi\utils\HttpMethod;
use venndev\restapi\utils\router\RouterData;
use vennv\vapm\System;

final class Application
{

    private static \Slim\App $app;

    public function __construct()
    {
        self::$app = AppFactory::create();
    }

    public static function getApp(): \Slim\App
    {
        return self::$app;
    }

    public function enable(): void
    {
        $this->loadRouters();

        try {
            self::$app->run(); // Run the application
        } catch (Throwable $e) {
            echo $e->getMessage();
        }
    }

    private function loadRouters(): void
    {
        FileManager::callAllPhpFiles(
            'controllers',
            /**
             * @throws ReflectionException
             * @throws Throwable
             */
            function ($file) {
                $class = 'venndev\restapi' . DIRECTORY_SEPARATOR . str_replace('.php', '', $file);
                $router = new $class();

                $classReflection = new ReflectionClass($class);
                $methods = $classReflection->getMethods();
                $attributes = $classReflection->getAttributes();
                // This is the group of the router
                $group = '';
                foreach ($attributes as $attribute) {
                    $attribute = $attribute->newInstance();
                    if ($attribute instanceof RequestMapping) $group = $attribute->value;
                }

                self::$app->group($group, function (RouteCollectorProxy $group) use ($methods, $router) {
                    foreach ($methods as $method) {
                        $attributes = $method->getAttributes();
                        $method = $method->getName();
                        foreach ($attributes as $attribute) {
                            $attribute = $attribute->newInstance();
                            if ($attribute instanceof RequestMapping) {
                                $callable = function (Request $request, Response $response, array $args) use ($router, $method, $attribute) {
                                    $response->withHeader('Content-Type', $attribute->produces);

                                    $queryParamsFromUrl = $request->getQueryParams();

                                    $queryParams = [];
                                    foreach ($attribute->queryParams as $value) isset($queryParamsFromUrl[$value]) ? $queryParams[$value] = $queryParamsFromUrl[$value] : $queryParams[$value] = null;

                                    $response = $router->$method($request, $response, $args, $queryParams);

                                    System::runSingleEventLoop();
                                    return $response;
                                };

                                $middlewareAtt = $attribute->middleware;
                                $middleware = $middlewareAtt ?? fn($request, $handler) => $handler->handle($request);

                                if ($attribute->method == HttpMethod::GET) $group->get($attribute->value, $callable)->add($middleware);
                                if ($attribute->method == HttpMethod::POST) $group->post($attribute->value, $callable)->add($middleware);
                                if ($attribute->method == HttpMethod::PUT) $group->put($attribute->value, $callable)->add($middleware);
                                if ($attribute->method == HttpMethod::DELETE) $group->delete($attribute->value, $callable)->add($middleware);
                                if ($attribute->method == HttpMethod::PATCH) $group->patch($attribute->value, $callable)->add($middleware);
                                if ($attribute->method == HttpMethod::OPTIONS) $group->options($attribute->value, $callable)->add($middleware);
                            }
                        }
                    }
                });
            }
        );
    }

}