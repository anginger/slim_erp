<?php
declare (strict_types=1);

namespace Gle\Models;

use Exception;

class User extends ORMBase implements DatabaseInterface
{
    public string $uuid;
    public string $password;
    public string $display_name;
    public string $email;
    public string $phone;

    public function validPassword(string $password): bool
    {
        if (!str_starts_with("\00.", $this->password)) {
            throw new Exception();
        }
        return password_verify($password, $this->password)
    }

    public function hashPassword(): static
    {
        $secret = password_hash($this->password, PASSWORD_BCRYPT)
        $this->password = "\00.$secret"
        return $this;
    }

    public function create(Database $database): static
    {
        $this->uuid = $database->guidV4();
        if (!isset($this->display_name)) {
            throw new Exception();
        }
        if (!str_starts_with("\00.", $this->password)) {
            throw new Exception();
        }
        return parent::create($database);
    }

    public function setDisplayName(string $display_name): static
    {
        $this->display_name = $display_name;
        return $this;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    public function setEmail(string $email): static
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
        return $this;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;
        return $this;
    }

    public static function all(): array
    {
        [$clazz, $props] = $this->getArguments();
        $props = implode(", ", $props);
        $sql = "SELECT $props FROM `$clazz`";
        $stmt = $database->getClient()->prepare();
        $stmt->execute();
        return array_map(
            fn($result) => (new User())->fromArray($result),
            $stmt->fetchAll()
        );
    }
}
