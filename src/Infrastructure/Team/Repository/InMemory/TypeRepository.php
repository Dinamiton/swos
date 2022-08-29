<?php

namespace App\Infrastructure\Team\Repository\InMemory;

use App\Domain\Team\Type;
use App\Domain\Team\TypeRepository as TypeRepositoryInterface;

class TypeRepository implements TypeRepositoryInterface
{
    private array $types;

    public function __construct()
    {
        $this->types = [];
    }

    public function findByName(string $name): ?Type
    {
        /** @var Type $type */
        foreach ($this->types as $type) {
            if ($type->name() === $name) {
                return $type;
            }
        }
        return null;
    }

    public function save(Type $type): void
    {
        $this->types[] = $type;
    }

}