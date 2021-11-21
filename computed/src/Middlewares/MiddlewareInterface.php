<?php
// Justin PHP Framework
// (c)2021 SuperSonic(https://randychen.tk)
declare (strict_types=1);

namespace Slim\Middlewares;

use Slim\Kernel\Context;

interface MiddlewareInterface
{
    public static function toUse(Context $context): void;
}
