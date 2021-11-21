<?php
// Justin PHP Framework
// (c)2021 SuperSonic(https://randychen.tk)
declare (strict_types=1);

namespace Slim\Models;

use JsonSerializable;

abstract class ModelBase implements JsonSerializable
{
    public function fromArray(array $array): ModelInterface
    {
        foreach ($array as $key => $value) {
            $this->{$key} = $value;
        }
        assert($this instanceof ModelInterface);
        return $this;
    }

    public function jsonSerialize(): ?array
    {
        $result = $this->toArray();
        return !empty($result) ? $result : null;
    }

    public function toArray(): array
    {
        return (array)$this;
    }
}
