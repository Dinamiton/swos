<?php

namespace App\Infrastructure\Team\Repository\InMemory;
use App\Domain\Team\Team;
use App\Domain\Team\TeamRepository as TeamRepositoryInterface;

class TeamRepository implements TeamRepositoryInterface
{

    private array $teams;

    public function __construct()
    {
        $this->teams = [];
    }

    public function findOneByName(string $name): ?Team
    {
        /** @var Team $team */
        foreach ($this->teams as $team) {
            if ($team->name() === $name) {
                return $team;
            }
        }
        return null;
    }

    public function save(Team $team): void
    {
        $this->teams[] = $team;
    }
}