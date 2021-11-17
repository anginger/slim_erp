<?php
declare (strict_types=1);

namespace Gle\Models;

use Exception;

class Product extends ORMBase implements DatabaseInterface
{
    public string $uuid;
    public string $display_name;

    public function create(Database $database): static
    {
        $this->uuid = $database->guidV4();
        if (!isset($this->display_name)) {
            throw new Exception();
        }
        return parent::create($database);
    }

    public function getDisplayName(): string
    {
        return $this->display_name;
    }

    public function setDisplayName(string $display_name): static
    {
        $this->display_name = $display_name;
        return $this;
    }
}
