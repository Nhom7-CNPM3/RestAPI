<?php

declare(strict_types=1);

namespace venndev\restapi\utils\attributes;

use Attribute;
use AllowDynamicProperties;
use venndev\restapi\utils\HttpMethod;

#[AllowDynamicProperties] #[Attribute(Attribute::TARGET_FUNCTION|Attribute::TARGET_METHOD|Attribute::TARGET_CLASS)]
final class RequestMapping
{

    public string $value = '';
    public array $queryParams = []; // Example: ["name", "age"]
    public array $produces = ['application/json']; // Default to 'application/json
    public HttpMethod $method = HttpMethod::GET;
    public ?object $middleware = null;

    public function __construct(array $args)
    {
        if (isset($args['value'])) $this->value = $args['value'];
        if (isset($args['queryParams'])) $this->queryParams = $args['queryParams'];
        if (isset($args['produces'])) $this->produces = $args['produces'];
        if (isset($args['method'])) $this->method = $args['method'];
        if (isset($args['middleware'])) $this->middleware = $args['middleware'];
    }

}