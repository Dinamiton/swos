<?php

namespace App\Domain\Team;

interface TypeRepository
{
    public function save(Type $type): void;
    public function findByName(string $name): ?Type;
}