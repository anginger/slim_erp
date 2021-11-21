<?php

namespace Slim\Models;

use Slim\Kernel\Database;
use TypeError;

class Level extends ModelBase implements ModelInterface
{
    public int $_id;
    public string $display_name;

    use ModelUtils;

    public function checkReady(): bool
    {
        return isset($this->_id);
    }

    public function load(Database $db_instance, $filter): ModelInterface
    {
        if (!is_int($filter)) {
            throw new TypeError();
        }
        $sql = "SELECT `_id`, `display_name` FROM `levels` WHERE `_id` = ?";
        $stmt = $db_instance->getClient()->prepare($sql);
        $stmt->execute([$filter]);
        $this->loadResult($this, $stmt);
        return $this;
    }

    public function reload(Database $db_instance): ModelInterface
    {
        return $this->load($db_instance, $this->_id);
    }

    public function create(Database $db_instance): bool
    {
        $sql = "INSERT INTO `levels`(`_id`, `display_name`) VALUES (:_id, :display_name)";
        $stmt = $db_instance->getClient()->prepare($sql);
        $db_instance->bindParamsFilled($stmt, $this->toArray());
        return $stmt->execute();
    }

    public function replace(Database $db_instance): bool
    {
        $sql = "UPDATE `levels` SET `display_name` = :display_name WHERE `_id` = :id";
        $stmt = $db_instance->getClient()->prepare($sql);
        $db_instance->bindParamsFilled($stmt, $this->toArray());
        return $stmt->execute();
    }

    public function destroy(Database $db_instance): bool
    {
        $sql = "DELETE FROM `levels` WHERE `_id` = ?";
        $stmt = $db_instance->getClient()->prepare($sql);
        return $stmt->execute([$this->_id]);
    }
}
