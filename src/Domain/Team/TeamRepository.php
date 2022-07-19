<?php

namespace App\Domain\Team;

interface TeamRepository
{
    public function findByName(string $name): ?Team;
    public function save(Team $team): void;
}