<?php

namespace Slim\Middlewares;

use Slim\Kernel\Context;

class CORS implements MiddlewareInterface
{
    public const METHOD_GET = "GET";
    public const METHOD_POST = "POST";
    public const METHOD_PUT = "PUT";
    public const METHOD_PATCH = "PATCH";
    public const METHOD_DELETE = "DELETE";
    public const METHOD_OPTIONS = "OPTIONS";

    public static function toUse(Context $context): void
    {
        $config = $context->getState()->get("allow_cors");
        if (is_null($config)) return;
        assert($config instanceof AllowCORS);
        $context
            ->getResponse()
            ->setHeader("Access-Control-Allow-Origin", $config->getAllowOrigin())
            ->setHeader("Access-Control-Allow-Methods", implode(", ", $config->getAllowMethods()))
            ->setHeader("Access-Control-Allow-Headers", implode(", ", $config->getAllowHeaders()));
        if ($config->getAllowCredentials()) {
            $context
                ->getResponse()
                ->setHeader("Access-Control-Allow-Credentials", "true");
        }
    }
}
