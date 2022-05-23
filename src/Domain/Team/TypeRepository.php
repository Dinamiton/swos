<?php

namespace App\Domain\Team;

interface TypeRepository
{
    public function save(Type $type): void;
    public function findOneByName(string $name): ?Type;
}