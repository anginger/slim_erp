<?php
declare (strict_types=1);

namespace Slim\Models;

use Exception;
use Slim\Kernel\Database;

class Product extends ORMBase implements DatabaseInterface
{
    public string $uuid;
    public string $display_name;

    public function create(Database $db_instance): bool
    {
        $this->uuid = $db_instance->guidV4();
        if (!isset($this->display_name)) {
            throw new Exception();
        }
        return parent::create($db_instance);
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
