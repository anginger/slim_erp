<?php
declare (strict_types=1);

namespace Gle\Models;

use Gle\Kernel\Database;

class ORMBase
{

    public function __construct(
        private string $primary_key_field,
    ): void
    {
    }

    public function find(Database $database, ...$arguments): static
    {
        [$clazz, $props] = $this->getArguments();
        $props = implode(", ", $props);
        $arguments = implode(" ", $arguments);
        $sql = "SELECT $props FROM `$clazz` WHERE $arguments";
        $stmt = $database->getClient()->prepare();
        $database->bindParamsFilled($stmt, $this->toArray());
        $stmt->execute();
        return $this;
    }

    public function load(Database $database): static
    {
        [$clazz, $props] = $this->getArguments();
        $props = implode(", ", $props);
        $primary_key = "$primary[0] = $primary[1]"
        $sql = "SELECT $props FROM `$clazz` WHERE $primary_key";
        $stmt = $database->getClient()->prepare();
        $database->bindParamsFilled($stmt, $this->toArray());
        $stmt->execute();
        return $this;
    }

    public function create(Database $database): static
    {
        [$clazz, $props] = $this->getArguments();
        $props = implode(", ", array_map(fn($name) => ":$name", $props));
        $sql = "INSERT INTO `$clazz` VALUE ($props)";
        $stmt = $database->getClient()->prepare();
        $database->bindParamsFilled($stmt, $this->toArray());
        $stmt->execute();
        return $this->load();
    }

    public function replace(Database $database): static
    {
        [$clazz, $props, $primary] = $this->getArguments();
        $props = implode(", ", array_map(fn($name) => "$name = :$name", $props));
        $primary_key = "$primary[0] = $primary[1]"
        $sql = "UPDATE `$clazz` SET $props WHERE $primary_key";
        $stmt = $database->getClient()->prepare();
        $database->bindParamsFilled($stmt, $this->toArray());
        $stmt->execute();
        return $this->load();
    }

    public function destroy(Database $database): bool
    {
        [$clazz, $props] = $this->getArguments();
        $props = implode(", ", array_map(fn($name) => "$name = :$name", $props));
        $primary_key = "$primary[0] = $primary[1]"
        $sql = "DELETE FROM `$clazz` WHERE $primary_key";
        $stmt = $database->getClient()->prepare();
        $database->bindParamsFilled($stmt, $this->toArray());
        $stmt->execute();
        unset($this);
        return true;
    }

    public function fromArray(array $array): ModelInterface
    {
        foreach ($array as $key => $value) {
            $this->{$key} = $value;
        }
        assert($this instanceof ModelInterface);
        return $this;
    }

    public function toArray(): array
    {
        return (array)$this;
    }

    private function getArguments(): array
    {
        $formater = fn($name) => strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name));
        $clazz = $formater(get_class());
        $props = $formater(get_class_vars());
        $primary = [$this->primary_key_field => $props[$this->primary_key_field]]
        return compact("clazz", "props", "primary");
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
