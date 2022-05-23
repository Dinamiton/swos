<?php

namespace App\Domain\Team;

interface TeamRepository
{
    public function findOneByName(string $name): ?Team;
    public function save(Team $team): void;
}