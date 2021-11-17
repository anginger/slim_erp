<?php

namespace Gle\Models;

use Gle\Kernel\Database;
use JsonSerializable;

interface DatabaseInterface extends JsonSerializable
{
    public function checkReady(): bool;

    public function find(Database $db_instance, ...$arguments): DatabaseInterface;

    public function load(Database $db_instance): DatabaseInterface;

    public function create(Database $db_instance): bool;

    public function replace(Database $db_instance): bool;

    public function destroy(Database $db_instance): bool;
}
