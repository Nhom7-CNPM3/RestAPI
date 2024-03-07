<?php

declare(strict_types=1);

namespace venndev\restapi\utils;

enum HttpMethod
{
    case GET;
    case POST;
    case PUT;
    case DELETE;
    case PATCH;
    case OPTIONS;
}
