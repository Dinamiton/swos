<?php

namespace App\Domain\Team;

class Type
{
    private array $available = ['club', 'national'];
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
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