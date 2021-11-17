<?php
declare (strict_types=1);

namespace Gle\Controllers;

use Gle\Kernel\Context;
use Gle\Models\Rectangle;

final class Shape
{
    public function getRectangle(Context $context): void
    {
        $width = $context->getRequest()->getQuery("width");
        $height = $context->getRequest()->getQuery("height");
        $instance = new Rectangle(floatval($width), floatval($height));
        $context->getResponse()->setBody($instance)->sendJSON();
    }
}
