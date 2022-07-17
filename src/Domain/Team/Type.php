<?php

namespace App\Domain\Team;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Type
{
    private array $available = ['club', 'national'];
    private UuidInterface $id;
    private string $name;
    private ?\ArrayObject $teams;

    public function __construct(string $name, ?\ArrayObject $teams = null)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->teams = $teams;
    }

    private function setName(string $name): void
    {
        if (!in_array($name, $this->available)) {
            throw new TypeNotAllowedException(
                sprintf("type %s is not allowed", $name)
            );
        }
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}