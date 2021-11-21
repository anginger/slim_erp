<?php
declare (strict_types=1);

namespace Slim\Models;

use Slim\Kernel\Database;

class ORMBase implements DatabaseInterface
{
    protected string $clazz;
    /**
     * @var array|string[]
     */
    protected array $props;
    protected array $primary;

    public function __construct(
        protected string $primary_key_field,
    )
    {
        $formatter = fn($name) => strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));
        $this->clazz = $formatter(get_class());
        $this->props = array_map($formatter, get_class_vars($this->clazz));
        $this->primary = [$this->primary_key_field, $this->props[$this->primary_key_field]];
    }

    public function checkReady(): bool
    {
        return isset($this->primary[1]);
    }

    public function find(Database $db_instance, ...$arguments): static
    {
        $props = implode(", ", $this->props);
        $arguments = implode(" ", $arguments);
        $sql = "SELECT {$props} FROM `{$this->clazz}` WHERE {$arguments}";
        $stmt = $db_instance->getClient()->prepare($sql);
        $db_instance->bindParamsFilled($stmt, $this->toArray());
        $stmt->execute();
        return $this;
    }

    public function load(Database $db_instance): static
    {
        $props = implode(", ", $this->props);
        $primary_key = "{$this->primary[0]} = {$this->primary[1]}";
        $sql = "SELECT {$props} FROM `{$this->clazz}` WHERE {$primary_key}";
        $stmt = $db_instance->getClient()->prepare($sql);
        $db_instance->bindParamsFilled($stmt, $this->toArray());
        $stmt->execute();
        return $this;
    }

    public function create(Database $db_instance): bool
    {
        $props = implode(", ", array_map(fn($name) => ":$name", $this->props));
        $sql = sprintf("INSERT INTO `%s` VALUE (%s)", $this->clazz, $props);
        $stmt = $db_instance->getClient()->prepare($sql);
        $db_instance->bindParamsFilled($stmt, $this->toArray());
        return $stmt->execute();
    }

    public function replace(Database $db_instance): bool
    {
        $props = implode(", ", array_map(fn($name) => "$name = :$name", $this->props));
        $primary_key = "{$this->primary[0]} = {$this->primary[1]}";
        $sql = "UPDATE `{$this->clazz}` SET {$props} WHERE {$primary_key}";
        $stmt = $db_instance->getClient()->prepare($sql);
        $db_instance->bindParamsFilled($stmt, $this->toArray());
        return $stmt->execute();
    }

    public function destroy(Database $db_instance): bool
    {
        $primary_key = "{$this->primary[0]} = {$this->primary[1]}";
        $sql = sprintf("DELETE FROM `%s` WHERE %s", $this->clazz, $primary_key);
        $stmt = $db_instance->getClient()->prepare($sql);
        $db_instance->bindParamsFilled($stmt, $this->toArray());
        return $stmt->execute();
    }

    public function fromArray(array $array): DatabaseInterface
    {
        foreach ($array as $key => $value) {
            $this->{$key} = $value;
        }
        return $this;
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
