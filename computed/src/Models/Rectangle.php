<?php
declare (strict_types=1);

namespace Gle\Models;

use Exception;
use JSONSerializable;

class Rectangle implements JSONSerializable
{
    public function __construct(
        public float $width,
        public float $height,
    )
    {
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setWidth(float $width): static
    {
        $this->width = $width;
        return $this;
    }

    public function setHeight(float $height): static
    {
        $this->height = $height;
        return $this;
    }

    public function perimeter(): float
    {
        if ($this->width < 0 || $this->height < 0) {
            throw new Exception("Rectangle dimensions should be greater than zero");
        }
        return ($this->width + $this->height) * 2;
    }

    public function area(): float
    {
        if ($this->width < 0 || $this->height < 0) {
            throw new Exception("Rectangle dimensions should be greater than zero");
        }
        return $this->width * $this->height;
    }

    public function jsonSerialize(): array
    {
        return [
            "area" => $this->area(),
            "height" => $this->height,
            "perimeter" => $this->perimeter(),
            "width" => $this->width,
        ];
    }
}
